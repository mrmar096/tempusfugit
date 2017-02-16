<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <?php
            if($this->session->userdata("user")) {
                ?>
                <a data-target="#dropdown" class="btn btn-info btn-raised btn-fab btn-fab-mini homebutton dropdown-toggle"
                   data-toggle="dropdown"><i class="material-icons">av_timer</i> </a>
                <a id="title_nav" class="navbar-brand "><?= $title ?></a>

                <ul class="dropdown-menu menu-main">
                    <?php
                    if ($this->session->userdata("user")->type == ADMIN_USER) {
                        $this->load->view('admin/menu');
                    } else if($this->session->userdata("user")->type == NORMAL_USER) {
                        $this->load->view('user/menu');
                    }
                    ?>
                </ul>
                <?php
            }else{
            ?>
            <a id="title_nav" href="<?=base_url()?>" class="navbar-brand active">TEMPUSFUGIT</a>
            <?php
            }
            ?>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
        <?php
        if($this->session->userdata("user")) {
            $this->load->view('user/logged');
        }else{
            $this->load->view('user/login');
        }
        ?>
        </div>
    </div>
</div>