<div class="form-group">
  <label for="image" class="col-sm-3 control-label">Sectors</label>
  <div class="col-sm-6">
      <select name="sector" class="form-control">

        <?php foreach ($sectors as $sector): ?>
          
          <option value="<?php echo $sector->id ?>"> <?php echo $sector->circle_and_sector ?></option>

        <?php endforeach ?>

      </select>
  </div>
</div>