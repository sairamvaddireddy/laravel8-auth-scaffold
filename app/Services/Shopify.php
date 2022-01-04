<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class Shopify
{
    protected $secret;
    protected $api_key;
    protected $api_password;
    protected $api_version;
    protected $store_url;
    protected $url;

    
    public function __construct()
    {
        $this->secret = env('SHOPIFY_APP_SECRET');
        $this->api_key = env('SHOPIFY_API_KEY');
        $this->api_password = env('SHOPIFY_API_PASSWORD');
        $this->api_version = env('SHOPIFY_API_VERSION');
        $this->store_url = env('SHOPIFY_STORE_URL');
        $this->url = "https://{$this->api_key}:{$this->api_password}@{$this->store_url}/admin/api/{$this->api_version}/";
    }

    /**
     * Verifiying the integrity of data recived on the route 
     * 
     * This method will abort the request if the integrity check fails
     */
    public function verify(): void
    {
        // data received on the request
        $data = request()->getContent();

        //abort if hash_check fails
        abort_unless(
            hash_equals(
                // hmac header
                request()->server('HTTP_X_SHOPIFY_HMAC_SHA256'),
                // calculated hmac
                base64_encode(hash_hmac('sha256', $data, $this->secret, true))
            ),
            404,
            'You caught here!'
        );
    }

    public function getProducts(): array
    {
        return $this->parseResponse(
            $this->request($this->url . "products.json")
        )->products;
    }

    public function getProduct($id): object
    {
        return $this->parseResponse(
            $this->request($this->url . "products/{$id}.json")
        )->product;
    }

    public function updateProduct($id, $request): object
    {
        $data = json_encode([
            "product" => $request
        ]);
        return $this->parseResponse(
            $this->request($this->url . "products/{$id}.json", 'put', $data)
        )->product;
    }

    public function getVariantId($sku)
    {
        $query = <<<GQL
        query {
            productVariants(first: 1, reverse:true, query: "sku:$sku") {
              edges {
                node {
                    id
                }
              }
            }
          }
        GQL;

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $this->api_password
            ])->post($this->url . "graphql.json", [
                'query' => $query
            ]);
            return str_replace("gid://shopify/ProductVariant/", "", $response->json()['data']['productVariants']['edges'][0]['node']['id'] ?? false);
            
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getProductId($sku)
    {
        $query = <<<GQL
        query {
            products(first: 1, reverse:true, query: "sku:$sku") {
              edges {
                node {
                    id
                }
              }
            }
          }
        GQL; 

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $this->api_password
            ])->post($this->url . "graphql.json", [
                'query' => $query
            ]);
            return str_replace("gid://shopify/Product/", "", $response->json()['data']['products']['edges'][0]['node']['id'] ?? false);
            
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getInventoryItemId($sku)
    {
        $query = <<<GQL
        query {
            productVariants(first: 1, reverse:true, query: "sku:$sku") {
              edges {
                node {
                  inventoryItem {
                      id
                  }
                }
              }
            }
          }
        GQL;
        
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $this->api_password
            ])->post($this->url . "graphql.json", [
                'query' => $query
            ]);
            return str_replace("gid://shopify/InventoryItem/", "", $response->json()['data']['productVariants']['edges'][0]['node']['inventoryItem']['id'] ?? false);
            
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    public function getLocationId($inventory_item_id)
    {
        try {
            return $this->parseResponse(
                $this->request($this->url . "inventory_levels.json?inventory_item_ids=$inventory_item_id")
            )->inventory_levels[0]->location_id;
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    public function updateInventory($body)
    {
        try {
            return $this->parseResponse(
                $this->request($this->url . "inventory_levels/set.json", 'post', $body)
            );
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    public function getProductTags($product_id)
    {
        try {
            return $this->parseResponse(
                $this->request($this->url . "products/$product_id.json?fields=tags")
            )->product->tags ?? "";
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    public function setProductTags($product_id, $tags)
    {
        $body = json_encode((object) [
            "product" => (object) [
                "tags" => $tags
            ]
        ]);
        try {
            return $this->parseResponse(
                $this->request($this->url . "products/$product_id.json", "put", $body)
            )->product->tags;
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    public function getVariantDetails($variant_id)
    {
        try {
            return $this->parseResponse(
                $this->request($this->url . "variants/$variant_id.json?fields=id,price,inventory_quantity,product_id,inventory_item_id")
            )->variant;
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    public function getProductDetails($product_id)
    {
        try {
            return $this->parseResponse(
                $this->request($this->url . "products/$product_id.json?fields=id,status")
            )->product;
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    public function updatePrice($variant_id, $price)
    {
        $body = json_encode((object) [
            "variant" => (object) [
                "price" => $price
            ]
        ]);
        try {
            return $this->parseResponse(
                $this->request($this->url . "variants/$variant_id.json", "put", $body)
            )->variant->price;
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    public function request($url, $type = 'get', $body = [])
    {        
        try {
            $client = new Client([
                'headers' => [
                    'Content-Type'  => 'application/json',
                ]
            ]);

            switch ($type) { 
                case 'get':
                    return $client->get($url );
                case 'post' :
                    return $client->post($url, ['body' => $body]);
                case 'put':
                    return $client->put($url, ['body' => $body]);
                default:
                    return $client->get($url);
            }
        } catch (RequestException $exception) {
            throw $exception;
        }
    }

    private function parseResponse($response)
    {
        try{
            $response_json = json_decode( trim($response->getBody()->getContents()) );

            if ($response_json){
                return $response_json;
            }
            abort(400, 'something went wrong!');

        } catch (Exception $exception) {
            throw $exception;
        }
    }
}