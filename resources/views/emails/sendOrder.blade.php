<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <div style="margin:0;padding:0" bgcolor="#FFFFFF">
        <table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="en">
            <tbody>
                <tr height="32" style="height:32px">
                    {{-- <td>{{$dataOrder}}</td> --}}
                </tr>
                <tr align="center">
                    <td>
                        <div>
                            <div></div>
                        </div>
                        <table border="0" cellspacing="0" cellpadding="0"
                            style="padding-bottom: 20px;max-width: 1000px;min-width: 220px;width: 100%;">
                            <tbody>
                                <tr>
                                    <td width="8" style="width:8px"></td>
                                    <td>
                                        <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px;" align="center">
                                            <div
                                                style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word;">
                                                <div style="font-size:24px">Cám ơn bạn đã chọn Electro.</div>
                                                <div style="font-size:18px">Đơn hàng của bạn</div>
                                            </div>
                                            <div>
                                                <table
                                                    style="margin-bottom:20px;width: 100%;border-bottom: thin solid #dadce0;padding-bottom: 20px;">
                                                    <tbody>
                                                        <tr style="height: 40px;">
                                                            <th>Mã đơn hàng</th>
                                                            <th>Thời gian đặt</th>
                                                            <th>Trạng thái đơn hàng</th>
                                                            @if ($dataOrder['order']['finished_at'])
                                                                <th>Thời gian hoàn thành</th>
                                                            @endif
                                                            <th>Giá</th>
                                                        </tr>
                                                        <tr style="text-align: center;">
                                                            <td>{{$dataOrder['order']['id']}}</td>
                                                            <td>{{$dataOrder['order']['created_at']}}</td>
                                                            <td>{{$dataOrder['order']['status']}}</td>
                                                            @if($dataOrder['order']['finished_at'])
                                                                <th>{{$dataOrder['order']['finished_at']}}</th>
                                                            @endif
                                                            <td>{{$dataOrder['orderAmount']}}<sup>đ</sup></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <h4 style="text-align: left;margin-left: 25px;">CHI TIẾT ĐƠN HÀNG</h4>

                                                <table style="margin-bottom: 20px;width: 100%;">
                                                    <thead>
                                                        <tr style="height: 40px;border-top: 1px solid #dadce0;border-bottom: 1px solid #dadce0;">
                                                            <th>TT</th>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Ảnh</th>
                                                            <th>Số lượng</th>
                                                            <th>Giá</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dataOrder['orderDetail'] as $key => $product)
                                                        <tr style="text-align: center;">
                                                            <td>{{++$key}}</td>
                                                            <td>{{$product['productName']}}</td>
                                                            <td><img src="{{$product['productImage']}}"
                                                                    class="CToWUd a6T" tabindex="0" style="width: 80px;">
                                                                <div class="a6S" dir="ltr"
                                                                    style="opacity: 0.01; left: 403px; top: 385px;">
                                                                    <div id=":nn" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q"
                                                                        role="button" tabindex="0"
                                                                        aria-label="Tải xuống tệp đính kèm "
                                                                        data-tooltip-class="a1V"
                                                                        data-tooltip="Tải xuống">
                                                                        <div class="aSK J-J5-Ji aYr"></div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><strong>{{$product['productQuantity']}}</strong></td>
                                                            <td>{{$product['productAmount']}}<sup>đ</sup></td>
                                                        </tr>
                                                        @endforeach
                                                            
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="8" style="width:8px"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr height="32" style="height:32px">
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>