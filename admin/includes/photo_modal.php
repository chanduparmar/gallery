<?php require_once 'init.php'; ?>

<?php
$photos = Photo::find_all();



?>

<!-- Modal -->
<div id="photo-library" class="modal fade" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gallery System Library</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-9">
          <div class="thumbnails row">
            <!--Php COde hre -->
            <?php
            foreach ($photos as $photo) :
            ?>

            <div class="col-xs-2">
              <a href="" role="checkbox" arie-checked="false" tabindex="0" id="" href="#" class="thumbnail">
                <img class="modal_thumbnails img-responsive" src="<?=$photo->picture_path()?>" data="">
              </a>
              <div class="photo-id hidden"></div>
            </div>
          <?php endforeach; ?>

            <!-- Php loop-->
          </div>
        </div><!-- Col md 9 -->

        <div class="col-md-3">
          <div class="modal_sidebar"></div>
        </div>
      
      </div>
      <div class="modal-footer">
      <div class="row">
        <button type="button" id="set_user_image" disabled="disabled" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->