<div class="sidenav col-sm-3">
    <div class="sidenav-menu {{ setActive(['users/home']) }}">
        <a href="/drivers/home"><i class="fas fa-tachometer-alt mr-2"></i> Dashboard</a>
    </div>
    <div class="sidenav-menu {{ setActive(['drivers/loads']) }}">
        <a href="/drivers/loads"><i class="fas fa-box mr-2"></i>Open Loads</a>
    </div>
    <div class="sidenav-menu {{ setActive(['drivers/active-loads']) }}">
        <a href="/drivers/active-loads"><i class="fas fa-box mr-2"></i>Active Loads</a>
    </div>
    <div class="sidenav-menu {{ setActive(['drivers/trucks']) }}">
        <a href="/drivers/trucks"><i class="fas fa-truck-moving mr-2"></i> Trucks</a>
    </div>
    <div class="sidenav-menu {{ setActive(['drivers/bids']) }}">
        <a href="/drivers/bids"><i class="far fa-file-alt mr-2"></i> Bids</a>
    </div>
    <div class="sidenav-menu mb-5 {{ setActive(['drivers/payment-history']) }}">
        <a href="/drivers/payment-history"><i class="fas fa-money-check mr-2"></i> Payment History</a>
    </div>
</div>