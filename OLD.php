<div class="col-md-12" style="margin-top: 30px;margin-bottom: 30px;">
    <?php if($count <= 0) {?>
    <div class=" col-md-8 offset-md-2" style="display:flexjustify-content:center;">
        <h6 class="badge badge-danger" style="padding: 10px;">
            <?php echo date("d-m-Y"); ?></h6>
        <h1><?php echo date("H:i:sA"); ?></h1>
    </div>



    <button onclick="takeAttendance()" class="btn btn-xl btn-success btn-block" style="margin-top: 50px;">Clock
        In</button>
    <?php }else{ ?>
    <div class="d-flex justify-content-center align-items-center">
        <span
            style="height: 100px; width: 100px; border-radius: 50px;background-color:green;display:flex; justify-content:center; align-items:center;"><i
                class="fa fa-check" style="font-size: 30px; color:white;"></i></span>

    </div>
    <p class="text-center">You have already teken attendance for today!</p>
    <p class="text-center">We'll open it to you again tomorrow. Enjoy your day!!!</p>
    <?php } ?>
</div>