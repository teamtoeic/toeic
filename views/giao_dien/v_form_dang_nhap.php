<form action="dang_nhap.php" method="post">
			<div id="DangNhap" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<div class="text-center text-primary" style="font-size: 20px; font-weight: bold;">
								Đăng Nhập
							</div>
						</div>
						<div class="modal-body">
          					<div class="form-group input-group">
            					<span class="input-group-addon">
            						<span class="glyphicon glyphicon-link"></span>
            					</span>
             					<input type="text" name="user_login" class="form-control" placeholder="Tên tài khoản...">
          					</div>
          					<div class="form-group input-group">
            					<span class="input-group-addon">
            						<span class="glyphicon glyphicon-link"></span>
            					</span>
             					<input type="password" name="pass_login" class="form-control" placeholder="Mật Khẩu...">
          					</div>
          					<div class="text-right"><a href="forgot_pass.php"> Quên Mật Khẩu ? </a></div>
						</div>
						<div class="modal-footer">
							<div>
								<button type="submit" name="dang_nhap" class="btn btn-primary">Đăng Nhập</button>
								<button type="button" name="exit" class="btn btn-danger" data-dismiss="modal">Thoát</button>
							</div>
						</div>
					</div>
				</div>
			</div>
    </form>