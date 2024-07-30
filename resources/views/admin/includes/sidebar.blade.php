<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <a href ="{{ route('backend-dashboard') }}" @class(['active' => Request::is('admin-dashboard')])>
                        <i data-feather="grid"></i>
                        <span>Dashboard</span>
                    </a>
                    <ul>
                        <li class="submenu"> </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    @canany([
                        'view users',
                        'view categories',
                        'view product',
                        'view prices',
                        'view discounts',
                        'view
                        roles & permissions',
                        ])
                        <h6 class="submenu-hdr">Inventory</h6>
                    @endcanany
                    <ul>
                        <li @class([
                            'active' => Request::is(
                                'admin/stores',
                                'admin/stores/create',
                                'admin/stores/*/edit'),
                        ])>
                            <a href="{{ route('stores.index') }}"><i data-feather="shopping-bag"></i>
                                <span>Stores</span>
                            </a>
                        </li>
                        @canany(['view users'])
                            <li @class(['active' => Request::is('admin/users', 'admin/users/*')])>
                                <a href="{{ route('users.index') }}">
                                    <i data-feather="user"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view categories'])
                            <li @class([
                                'active' => Request::is('admin/categories', 'admin/categories/*'),
                            ])>
                                <a href="{{ route('categories.index') }}">
                                    <i data-feather="file-text"></i>
                                    <span>Categories</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view product'])
                            <li @class([
                                'active' => Request::is('admin/products', 'admin/products/*'),
                            ])>
                                <a href="{{ route('products.index') }}">
                                    <i data-feather="speaker"></i>
                                    <span>Product Master</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view prices'])
                            <li @class(['active' => Request::is('admin/prices', 'admin/prices/*')])>
                                <a href="{{ route('prices.index') }}">
                                    <i data-feather="trending-down"></i>
                                    <span>Price Master</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view discounts'])
                            <li @class([
                                'active' => Request::is('admin/discounts', 'admin/discounts/*'),
                            ])>
                                <a href="{{ route('discounts.index') }}">
                                    <i data-feather="codesandbox"></i>
                                    <span>Discount Master</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view sales'])
                            <li @class(['active' => Request::is('admin/sales', 'admin/sales/*')])>
                                <a href="{{ route('sales.index') }}">
                                    <i data-feather="box"></i>
                                    <span>Sales Details</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view return stocks'])
                            <li @class([
                                'active' => Request::is(
                                    'admin/return-stocks',
                                    'admin/return-stocks/*'),
                            ])>
                                <a href="{{ route('return_stocks.index') }}">
                                    <i data-feather="box"></i>
                                    <span>Return Stocks</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view customers'])
                            <li @class([
                                'active' => Request::is('admin/customers', 'admin/customers/*'),
                            ])>
                                <a href="{{ route('customers.index') }}">
                                    <i data-feather="codepen"></i>
                                    <span>Customer Master</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view inventory transfers'])
                            <li @class([
                                'active' => Request::is(
                                    'admin/inventory-transfer',
                                    'admin/inventory-transfer/*'),
                            ])>
                                <a href="{{ route('inventory-transfer.index') }}"><i data-feather="tag"></i>
                                    <span>Inventory Transfer</span>
                                </a>
                            </li>
                        @endcanany
                        @canany(['view roles & permissions'])
                            <li @class([
                                'active' => Request::is(
                                    'admin/roles-and-permissions',
                                    'admin/roles-and-permissions/*'),
                            ])>
                                <a href="{{ route('roles-and-permissions.index') }}">
                                    <i data-feather="shield"></i>
                                    <span>Roles & Permissions</span>
                                </a>
                            </li>
                        @endcanany
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
