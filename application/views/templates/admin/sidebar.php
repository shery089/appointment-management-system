<!-- Sidebar -->
<div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <!-- <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    /input-group
                </li> -->
    
        <?php $controller = $this->uri->segment(2); ?>

                <li>
                    <a <?= isset($controller) && $controller == 'dashboard'  ? 'class="active"' : '' ?> href="<?= site_url('a/dashboard'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li>
                    <a <?= isset($controller) && $controller == 'doctor_specialization'  ? 'class="active"' : '' ?> href="<?= site_url('a/doctor_specialization'); ?>"><i class="fa fa-medkit fa-fw"></i> Doctor Specialization</a>
                </li>
    
                <li>        
                    <a <?= isset($controller) && $controller == 'disease'  ? 'class="active"' : '' ?> href="<?= site_url('a/disease'); ?>"><i class="fa fa-cubes fa-fw"></i> Disease</a>
                </li>
    
                <li>        
                    <a <?= isset($controller) && $controller == 'admin'  ? 'class="active"' : '' ?> href="<?= site_url('a/admin'); ?>"><i class="fa fa-user fa-fw"></i> Admin</a>
                </li>

                <li>        
                    <a <?= isset($controller) && $controller == 'doctor'  ? 'class="active"' : '' ?> href="<?= site_url('a/doctor'); ?>"><i class="fa fa-user-md fa-fw"></i> Doctor</a>
                </li>

                <li>        
                    <a <?= isset($controller) && $controller == 'patient'  ? 'class="active"' : '' ?> href="<?= site_url('a/patient'); ?>"><i class="fa fa-plus-square fa-fw"></i> Patient</a>
                </li>

                <li>        
                    <a <?= isset($controller) && $controller == 'schedule'  ? 'class="active"' : '' ?> href="<?= site_url('a/schedule'); ?>"><i class="fa fa-calendar fa-fw"></i> Schedule</a>
                </li>

                <li>        
                    <a <?= isset($controller) && $controller == 'appointment'  ? 'class="active"' : '' ?> href="<?= site_url('a/appointment'); ?>"><i class="fa fa-clock-o fa-fw"></i> Appointment</a>
                </li>

                <li>        
                    <a <?= isset($controller) && $controller == 'prescription'  ? 'class="active"' : '' ?> href="<?= site_url('a/prescription'); ?>"><i class="fa fa-file-text-o fa-fw"></i> Prescription</a>
                </li>                
            </ul>    
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<!-- / Sidebar -->