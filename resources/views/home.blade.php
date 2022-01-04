@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
    <home-statistic title="Shopify Orders" type="primary" value={{ $shopifyOrders }} icon="b fa-shopify">
    </home-statistic>
    <home-statistic title="Inventory Updates" type="success" value={{ $inventoryUpdates }} icon='s fa-boxes'>
    </home-statistic>
    <home-statistic title="Failed Shopify Orders" type="danger" value={{ $failedOrders }} icon='s fa-ban'>
    </home-statistic>
    <home-statistic title="Failed Inventory Updates" type="warning" value={{ $failedUpdates }} icon='s fa-pause-circle'>
    </home-statistic>
</div>
<div class="row">
    <link-card link="{{ route('home') }}" title="users">
    </link-card>
    <link-card link="{{ route('roles.index') }}" title="roles" type="success" icon="s fa-user-shield">
    </link-card>
    <link-card link="{{ route('home') }}" title="shopify orders" type="danger" icon="b fa-shopify">
    </link-card>
    <link-card link="{{ route('home') }}" title="inventory updates" type="secondary" icon="s fa-boxes">
    </link-card>
</div>
@endsection