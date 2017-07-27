<form action="profile.php" method="post">
							<div class="text-center text-primary" style="font-size: 20px; font-weight: bold;">
								<h2>Thông tin của bạn</h2>
							</div>
          			<div class=" col-md-offset-2 col-md-7 form-group input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-link"></span>
                      </span>
                      <input type="text" name="ten_nguoi_dung" class="form-control" placeholder="Tên Người Dùng..." value="<?php echo $nguoi_dung["ten_nguoi_dung"] ?>">
                    </div>
                    <div class="col-md-offset-2 col-md-7 form-group input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-link"></span>
                      </span>
                      <input type="text" name="dia_chi" class="form-control" placeholder="Địa Chỉ..." value="<?php echo $nguoi_dung["dia_chi"] ?>">
                    </div>
                    <div class="col-md-offset-2 col-md-7 form-group input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-link"></span>
                      </span>
                      <input type="email" name="email" class="form-control" placeholder="Email..." value="<?php echo $nguoi_dung["email"] ?>">
                    </div>
                    <div class="col-md-offset-2 col-md-7 form-group input-group">
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-link"></span>
                      </span>
                      <input type="text" name="sdt" class="form-control" placeholder="Số Điện Thoại..." value="<?php echo $nguoi_dung["sdt"] ?>">
                    </div>
                    <div class="col-md-offset-5 col-md-3">
                     <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                     </div>
						  </div>
    </form>