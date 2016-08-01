<?php
require_once('../../../vendor/mpdf/mpdf/mpdf.php');
include_once('../../../vendor/autoload.php');
use App\Admin\Admin;
$obj= new Admin();
$allData= $obj->orderList();
$trs="";
$sl=0;
foreach($allData as $data):
    $sl++;
    $trs.="<tr>";
    $trs.="<td>$sl </td>";
    $trs.="<td>".$data['order_id']."</td>";
    $trs.="<td>".$data['food_code']."</td>";
    $trs.="<td>".$data['food_name']."</td>";
    $trs.="<td>".$data['quantity']."</td>";
    $trs.="<td>".$data['user_id']."</td>";
    $trs.="<td>".$data['current_date']."</td>";
    $trs.="</tr>";
endforeach;
$html=<<<EOD
<table class="table">
            <thead>
            <tr>
                <th>SL </th>
                <th>Order ID </th>
                <th>Food Code</th>
                <th>Food Name</th>
                <th>Quantity </th>
                <th>User ID</th>
                <th>Current Date</th>

           </tr>
            </thead>
            <tbody>
                 $trs
            </tbody>
</table>
EOD;

$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('OrderList.pdf','D');