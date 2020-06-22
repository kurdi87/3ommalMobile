        <table>
                    <tr>
                    <td colspan="2" align="center">
                    <span  class="titleInvoice">فاتورة</span>
                    </td>
                    </tr>
                        <tr>
                            <td class="title">
                                <img src="uploads/logoPrint.png" width="300" height="100">
                            </td>
                            
                            <td>
                                <span class="bold">رقم الفاتورة:  </span> {{$invoice->invoice_id}}<br>
                                <span class="bold">تاريخ الإنشاء:  </span> {{$invoice->date}}<br>
                                <span class="bold">تاريخ الإغلاق:  </span>{{$invoice->close_date}}
                            </td>
                        </tr>
                    </table>