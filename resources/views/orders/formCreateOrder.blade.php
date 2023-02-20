<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/front-end/plugins/fontawesome/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Delivery</title>
</head>

<body>
    <style>
        .container {
            width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .delivery-content-top-left {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .delivery-content {
            display: flex;
        }

        .delivery-content-right {
            background-color: rgb(240, 240, 240);
            width: 30%;
            margin-left: 20px;
            padding: 10px;
        }

        input {
            margin-bottom: 10px;
            padding: 10px;
        }

        .name-phone {
            display: flex;
            justify-content: space-between;
            width: auto;
        }

        .name input {
            width: 350px;
        }

        .phone input {
            width: 300px;
        }

        .adress input {
            width: 100%;
        }

        .email input {
            width: 100%;
        }

        .delivery-content-left-phuongthucgiaohang input {
            width: 100%;
        }

        .delivery-content-left-ghichu input {
            width: 100%;
        }

        .order-center {
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 1px solid rgb(129, 134, 136);
            padding: 10px;
            border-bottom: 1px solid rgb(129, 134, 136);
        }

        .product-order {
            display: flex;
            margin-top: 10px;
            justify-content: space-between;
        }

        .order-center-left {
            display: flex;
        }

        .img-product {
            margin-right: 10px;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .voucher {
            margin-bottom: 20px;
        }

        .voucher input {
            width: 100%;
            background-color: rgb(230, 234, 237);
        }

        .order-bottom {
            border-bottom: 1px solid rgb(129, 134, 136);
            padding-bottom: 10px;
        }

        .total-money {
            margin-top: 20px;
            font-weight: bold;
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }
        .adress{
            display: flex;
            justify-content: space-between;
        }
        .form-select{
            width: 210px;
        }

    </style>
    <section class="delivery">
        <div class="container">
            <div class="delivery-content">
                <div class="delivery-content-left ">
                    <div class="delivery-content-top-left">
                        <div class="delivery-content-left-thongtinkhachhang">
                            Thông tin khách hàng
                        </div>
                        <div class="delivery-content-left-login">
                            <p><span>Đã đăng ký? </span><button type="button" class="btn btn-success">Đăng nhập</button>
                            </p>
                        </div>
                    </div>
                    <div class="delivery-content-left-email">
                        <div class="email"><input type="email" name="email" placeholder="Email Adress ( optional )" ></div>
                        <div>

                            <div>
                                <input type="checkbox" name="luachon">
                                <label>I accept to receive shop updates, promotions and other marketing information from
                                    SHOP</label>
                            </div>
                        </div>
                    </div>
                    <div class="delivery-content-left-chitietgiaohang">
                        <div>
                            <div class="name-phone">
                                <div class="name"><input type="text" name="name" id="" placeholder="Tên người nhận" ></div>
                                <div class="phone"><input type="tel" name="phone" id="" placeholder="Số điện thoại" > </div>

                            </div>
                            <div class="adress">
                                <input type="text" name="adress" placeholder="Địa chỉ" >

                            </div>
                            <div class="adress">

                                <div>
                                    <select class="form-select form-select-lg mb-3 "  id="city"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn tỉnh thành</option>
                                    </select>
                                </div>

                                <div>
                                    <select class="form-select form-select-lg mb-3 " id="district"
                                        aria-label=".form-select-sm">
                                        <option value="" selected>Chọn quận huyện</option>
                                    </select>
                                </div>
                                <div>
                                    <select class="form-select form-select-lg " id="ward" aria-label=".form-select-sm">
                                        <option value="" selected>Chọn phường xã</option>
                                    </select>
                                </div>


                            </div>


                            <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
                            <script>
                                var citis = document.getElementById("city");
                                var districts = document.getElementById("district");
                                var wards = document.getElementById("ward");
                                var Parameter = {
                                    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
                                    method: "GET",
                                    responseType: "application/json",
                                };
                                var promise = axios(Parameter);
                                promise.then(function (result) {
                                    renderCity(result.data);
                                });

                                function renderCity(data) {
                                    for (const x of data) {
                                        citis.options[citis.options.length] = new Option(x.Name, x.Id);
                                    }
                                    citis.onchange = function () {
                                        district.length = 1;
                                        ward.length = 1;
                                        if (this.value != "") {
                                            const result = data.filter(n => n.Id === this.value);

                                            for (const k of result[0].Districts) {
                                                district.options[district.options.length] = new Option(k.Name, k.Id);
                                            }
                                        }
                                    };
                                    district.onchange = function () {
                                        ward.length = 1;
                                        const dataCity = data.filter((n) => n.Id === citis.value);
                                        if (this.value != "") {
                                            const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                                            for (const w of dataWards) {
                                                wards.options[wards.options.length] = new Option(w.Name, w.Id);
                                            }
                                        }
                                    };
                                }
                            </script>
                            <div>
                                <input type="checkbox" id="luudiachi">
                                <label for="luudiachi">Lưu địa chỉ mới này vào sổ địa chỉ của tôi</label>
                            </div>
                        </div>
                    </div>
                    <div class="delivery-content-left-phuongthucgiaohang">
                        <p>Phí vận chuyển : 30.000đ</p>
                        <input type="text" name="" id="" value="Giao hàng toàn quốc">
                    </div>
                    <div class="delivery-content-left-chitietthanhtoan">
                        <p>Phương thức thanh toán</p>
                        <input type="radio" name="checkout" id="thanhtoankhinhanhang">
                        <label for="thanhtoankhinhanhang">Thanh toán khi nhận hàng</label>
                        <input type="radio" name="checkout" id="nganhangdientu">
                        <label for="nganhangdientu">Ngân hàng điện tử</label>
                    </div>
                    <div class="delivery-content-left-ghichu">
                        <p>Thông tin khác</p>
                        <input type="text" placeholder="Để lại ghi chú cho đơn hàng">
                    </div>
                    <div class="delivery-content-left-order">
                        <button type="button" class="btn btn-success">Đặt hàng</button>
                    </div>

                </div>
                <div class="delivery-content-right">
                    <h4 style="text-align: center;">Danh sách sản phẩm</h4>
                    <div class="order-center">
                        <div class="product-order">
                            <div class="order-center-left">
                                <div class="img-product">
                                    <a href="#"><img src="img/sp1.jfif" alt="" width="60px" height="60px"></a>
                                </div>
                                <div class="info-product">
                                    <div>
                                        <div class="name-product">
                                            <a href="#">
                                                <p>Tên sản phẩm </p>
                                            </a>
                                        </div>
                                        <div class="amount-product">
                                            <p>x1</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="order-center-right">
                                <p>200.000đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="voucher">
                        <input type="text" placeholder="Nhập mã giảm giá">
                    </div>
                    <div class="order-bottom">
                        <div class="flex ">
                            <div>Tổng các mục :</div>
                            <div> 200.000đ</div>
                        </div>
                        <div class="flex">
                            <div>Phí vận chuyển :</div>
                            <div>30.000đ</div>
                        </div>

                    </div>
                    <div class="total-money flex">
                        <div>Tổng tiền hàng : </div>
                        <div>230.000đ</div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</body>

</html>
