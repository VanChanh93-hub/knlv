<?php if(isset($_SESSION['thongbao'])){
          echo '<h4 class="action_lienhe">'.$_SESSION['thongbao'] .'</h4>';
          unset($_SESSION['thongbao']);
      }?>
<main class="contact-section">

    <div class="contact-container">

      <div class="form-section">
        <h2>Viết phản hồi của bạn tại đây</h2>
        <form class="contact-form" action="index.php?act=contact" method="post">
          <input type="text" placeholder="Tên của bạn" name="name" required />
          <input type="email" placeholder="Email" name="email" required />
          <input type="text" placeholder="Vấn đề của bạn" name="problem" required />
          <textarea placeholder="Nội dung" rows="5" required name="message"></textarea>
          <button type="submit" name="submit">Gửi ngay</button>
        </form>
      </div>
      <div class="image-section">
        <img src="public/img/contact/Terracotta Modern Food Presentation (1).png" alt="Foodhub Logo" class="logo-image" />
      </div>
    </div>
</main>