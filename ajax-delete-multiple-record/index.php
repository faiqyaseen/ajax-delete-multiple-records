<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            margin: 0 auto;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center" style="background-color:peru;">
            <h1>DELETE MULTIPLE RECORD</h1>
        </div>

        <div class="row mt-2">
            <div class="col-md-3">
                <button class="btn btn-danger" id="deleteBtn">Delete</button>
            </div>
            <div class="col-md-6 text-center">
                <h3>Student Data</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Student Id</th>
                            <th>Student Name</th>
                            <th>Student Class</th>
                            <th>Student Age</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-multiple-del" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    ARE YOU SURE YOU WANT TO DELETE?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="alert fade" id="alert" role="alert">
        <span id="inner-message"></span>
        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> -->
    </div>


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadData() {
                $.ajax({
                    url: "load-data.php",
                    type: "GET",
                    success: function(data) {
                        $("#table-data").html(data);
                    }
                })
            }
            loadData()

            $("#deleteBtn").on("click", function() {
                var id = [];
                $(":checkbox:checked").each(function(key) {
                    id[key] = $(this).val();
                });
                if (id.length === 0) {
                    $(".alert").removeClass("fade").addClass("alert-danger");
                    $("#inner-message").html("Select atleast one record")
                    setTimeout(function() {
                        $(".alert").addClass("fade").removeClass("alert-danger alert-success alert-warning");
                        $("#inner-message").html("")
                    }, 3000)
                } else {
                    $("#modal-multiple-del").modal("show");
                    $("#confirm-delete").on("click", function() {
                        $.ajax({
                            url: "delete-data.php",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $("#modal-multiple-del").modal("hide");
                                if (data == 1) {
                                    $(".alert").removeClass("fade").addClass("alert-success");
                                    $("#inner-message").html("Selected Records Are Deleted")
                                    setTimeout(function() {
                                        $(".alert").addClass("fade").removeClass("alert-danger alert-success alert-warning");
                                        $("#inner-message").html("")
                                    }, 3000)
                                    loadData();
                                }
                                else if(data == 0) {
                                    $(".alert").removeClass("fade").addClass("alert-danger");
                                    $("#inner-message").html("Can\'t Deleted")
                                    setTimeout(function() {
                                        $(".alert").addClass("fade").removeClass("alert-danger alert-success alert-warning");
                                        $("#inner-message").html("")
                                    }, 3000)
                                }
                            }
                        })
                    })
                }
            })

        })
    </script>
</body>

</html>