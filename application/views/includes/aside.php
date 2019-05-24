<aside id="left-panel" class="left-panel">
<nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?php echo base_url('Home') ?>"><i class="menu-icon fa fa-home"></i>Home </a>
                    </li>

                    <li class="menu-title">Master Data</li><!-- /.menu-title -->
                    <?php if ($this->session->userdata('role') == 1): ?>
                        <li>
                        <a href="<?php echo base_url('Users') ?>"> <i class="menu-icon ti-user"></i>Users </a>
                    </li>
                    <?php endif ?>
                    <li>
                        <a href="<?php echo base_url('Product') ?>"> <i class="menu-icon ti-shopping-cart"></i>Product </a>
                    </li>

                    <li class="menu-title">Manufacturing</li><!-- /.menu-title -->
                    <li>
                        <a href="<?php echo base_url('Bom') ?>"> <i class="menu-icon ti-clipboard"></i>Bom </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Manufacturing') ?>"> <i class="menu-icon ti-package"></i>Manufacturing </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
        </aside><!-- /#left-panel -->