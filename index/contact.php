<?php include("master-view/header.php"); ?>

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          ĐẶT LỊCH KHÁM BỆNH
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container contact-form">
            <form method="GET" action="">
              <div class="form-row">
                <div class="col-lg-6">
                  <div>
                    <input type="text" placeholder="Nhập tên" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div>
                    <input type="text" placeholder="Số điện thoại" />
                  </div>
                </div>
              </div>
              <div>
                <input type="email" placeholder="Email" />
              </div>
              <div>
                <input type="date" placeholder="Ngày khám" />
              </div>
              <div>
                <input type="time" placeholder="Giờ khám" />
              </div>
              <div>
                <input type="option" placeholder="Chọn bác sĩ" />
              </div>
              <div>
                <input type="text" placeholder="Tiêu đề" />
              </div>
              <div class="btn_box">
                <button type="submit">
                  Gửi
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->
