<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BlueKeyboardSoftware | Admin</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>admin_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>admin_assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view('inc/sidebar');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('inc/header');?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col col-sm-6">
                            <h1 class="h3 mb-4 text-gray-800">Portfolio</h1>
                        </div>
                        <div class="col col-md-6">
                            <?php if($this->session->userdata('status')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Success!</strong> <?php echo $this->session->userdata('status') ?>
                                </div>
                            <?php } ?>


                            <?php if($this->session->userdata('error')) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Failed!</strong> <?php echo $this->session->userdata('error') ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                        <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Add New Portfolio
                    </button>
                
                    <div class="row justify-content-start">
                        <?php foreach($portfolios as $portfolio) { ?>
                            <div class="col-md-3 card m-3" style="width:400px">
                                <img class="card-img-top" src="<?php echo base_url() . 'assets/images/' . $portfolio->image ?>" alt="" style="width: 370px; height: 380px;">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $portfolio->title ?></h4>
                                    <p class="card-text"><?php echo $portfolio->description ?></p>
                                    <button 
                                        data-toggle="modal" 
                                        data-target="#myModal" 
                                        data-id="<?php echo $portfolio->id ?>" 
                                        data-image="<?php echo $portfolio->image ?>" 
                                        data-title="<?php echo $portfolio->title ?>" 
                                        data-description="<?php echo $portfolio->description ?>" 
                                        onclick="edit(event)"
                                        class="btn btn-primary">Edit</button>
                                    
                                    <a href="<?php echo base_url() . 'admin/portfolio/delete/' . $portfolio->id ?>" class="btn btn-danger">Delete</a> 
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- The Modal -->
    <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Portfolio</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <form action="<?php echo base_url() . 'admin/portfolio/store'?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <img style="height: 380px; width: 370px; display: none;" id="preview" />
                        </div>
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" accept="image/*" onChange="previewImage(event)" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group text-center">
                        <input type="hidden" name="id" id="id" readOnly />
                        <input type="submit" name="submit" id="submit" class="brn btn-success btn-lg" />
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
    </div>
    
    <?php $this->load->view('inc/footer');?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script>
        const base_url = "<?php echo base_url() ?>"

        function previewImage(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function edit(event) {

            const id = event.target.getAttribute("data-id")
            const image = event.target.getAttribute("data-image")
            const title = event.target.getAttribute("data-title")
            const description = event.target.getAttribute("data-description")

            const d_preview = document.getElementById("preview")
            const d_id = document.getElementById("id")
            const d_title = document.getElementById("title")
            const d_description = document.getElementById("description")
            const d_image = document.getElementById("image")
            
            d_preview.src = `${base_url}assets/images/${image}`
            d_preview.style.display = "block";

            d_id.value = id
            d_title.value = title
            d_description.value = description
            d_image.value = ""
        }
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>admin_assets/vendor/jquery/jquery.min.js"></script>
    
    <script src="<?php echo base_url(); ?>admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>admin_assets/js/sb-admin-2.min.js"></script>

</body>

</html>