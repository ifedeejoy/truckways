<div class="sidenav col-sm-3">
    <div class="sidenav-menu {{ setActive(['drivers/home']) }}">
        <a href="/drivers/home"><i class="fas fa-tachometer-alt mr-2"></i> Dashboard</a>
    </div>
    <div class="sidenav-menu {{ setActive(['drivers/loads']) }}{{ setActive(['drivers/load/*']) }}">
        <a href="/drivers/loads"><i class="fas fa-box mr-2"></i>Loads</a>
    </div>
    <div class="sidenav-menu {{ setActive(['drivers/my-bids']) }}">
        <a href="/drivers/my-bids"><i class="fas fa-box mr-2"></i>My Bids</a>
    </div>
    <div class="sidenav-menu {{ setActive(['drivers/trucks'])}}{{setActive(['drivers/add-truck']) }}{{setActive(['drivers/truck*']) }}">
        <a href="/drivers/trucks"><i class="fas fa-truck-moving mr-2"></i> Trucks</a>
    </div>
    <div class="sidenav-menu {{ setActive(['drivers/earnings']) }}">
        <a href="/drivers/earnings"><i class="far fa-file-alt mr-2"></i>Earnings</a>
    </div>
    <div class="sidenav-menu mb-5 {{ setActive(['drivers/journey-history']) }}">
        <a href="/drivers/journey-history"><i class="fas fa-money-check mr-2"></i>Journey History</a>
    </div>
</div>