<div>
  <h3>LIÊN HỆ</h3>
</div>
<div class="col-md-8 col-md-offset-1 contact-form">
  <form method="post">
  <div>
    <span>
      <label>Họ và tên</label>
    </span>
    <span>
      <input name="th_hoten" type="text" class="textbox">
    </span>
  </div>
  <div> 
    <span>
      <label>E-mail</label>
    </span> 
    <span>
      <input name="th_email" type="email" class="textbox">
    </span> 
  </div>
  <div> 
    <span>
      <label>Chủ đề</label>
    </span> 
    <span>
      <input name="th_chude" type="text" class="textbox">
    </span> 
  </div>
  <div> 
    <span>
      <label>Nội dung</label>
    </span> 
    <span>
      <textarea name="th_noidung"> </textarea>
    </span> 
  </div>
    <tr>
      <td>Nhập mã bảo vệ</td>
      <td><input type="text" id="security_code" name="security_code" style="width:100px !important; background-color:#CCC; border-style:none" />
            &nbsp;<img src="public/images/captcha/captcha.gif" alt="captcha" />
            
            <input type="image" name="th_recapcha" src="public/images/captcha/refresh.jpg" style="width:20px" value="recapcha"  />
      </td>
    </tr>
  <div> 
    <span>
      <input type="submit" name="th_gui" class="mybutton" value="Gửi" onclick="return kiemtralienhe()">
     </span> 
  </div>
  </form>
</div>