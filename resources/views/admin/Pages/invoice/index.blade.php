@extends('admin.layouts.app')
@section('title','Invoice')
@section('content')
<div class="content container-fluid">

    <div class="card">
  <div class="card-body" id="printableContent">
    <div class="mb-5 mt-3">
      <div class="px-4">
        <div class="col-md-12">
          <div class="text-center">
            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
            <p class="pt-0">MDBootstrap.com</p>
          </div>

        </div>


        <div class="row">
            <div class="d-flex justify-content-between">
          <div>
            <ul class="list-unstyled">
              <li class="text-muted">To: <span style="color:#5d9fc5 ;">John Lorem</span></li>
              <li class="text-muted">Street, City</li>
              <li class="text-muted">State, Country</li>
              <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
            </ul>
          </div>
          <div>
            <p class="text-muted">Invoice</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">ID:</span>#123-456</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Creation Date: </span>Jun 23,2021</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                  Unpaid</span></li>
            </ul>
          </div>
        </div>
        </div>

        <div class="row my-2 justify-content-center">
            <div class="table-responsive">
                <table class="table align-middle">
                <thead>
                <tr>
                <th style="width: 70px;">No.</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th class="text-end" style="width: 120px;">Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <th scope="row">01</th>
                <td>
                <div>
                <h5 class="text-truncate font-size-14 mb-1">Black Strap A012</h5>
                <p class="text-muted mb-0">Watch, Black</p>
                </div>
                </td>
                <td>$ 245.50</td>
                <td>1</td>
                <td class="text-end">$ 245.50</td>
                </tr>
                
                <tr>
                <th scope="row">02</th>
                <td>
                <div>
                <h5 class="text-truncate font-size-14 mb-1">Stainless Steel S010</h5>
                <p class="text-muted mb-0">Watch, Gold</p>
                </div>
                </td>
                <td>$ 245.50</td>
                <td>2</td>
                <td class="text-end">$491.00</td>
                </tr>
                
                <tr>
                <th scope="row" colspan="4" class="text-end">Sub Total :</th>
                <td class="text-end">$732.50</td>
                </tr>
                <hr>
                <tr>
                <th scope="row" colspan="4" class="border-0 text-end">
                Discount :</th>
                <td class="border-0 text-end">- $25.50</td>
                </tr>
                
                <tr>
                <th scope="row" colspan="4" class="border-0 text-end">Total :</th>
                <td class="border-0 text-end"><h4 class="m-0 fw-semibold">$739.00</h4></td>
                </tr>
                
                </tbody>
                </table>
                </div>
                <div class="d-print-none mt-4">
                <div class="float-end">
                <a href="javascript:window.print()" onclick="printContent()" class="btn btn-success me-1" id="print"><i class="fa fa-print"></i> Print</a>
                <button id="download-pdf" class="btn btn-success me-1"><i class="fa fa-download"></i> Download PDF</button>
                </div>
                </div>
                </div>
                <hr>
        </div>
        
        <div class="px-4 d-flex justify-content-between">
          <div>
            <p>Thank you for your purchase</p>
          </div>
          <div>
            <button type="button" class="btn btn-primary text-capitalize"
              style="background-color:#60bdf3 ;">Pay Now</button>
          </div>
        </div>

        

      </div>
    </div>
  </div>
</div>         

</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script>
  function printContent() {
      var contentToPrint = document.getElementById('printableContent').innerHTML;
      var originalContent = document.body.innerHTML;

      document.body.innerHTML = contentToPrint;

      window.print();

      // Restore the original content
      document.body.innerHTML = originalContent;
  }
</script>
<script>
  window.onload = function () {
    document.getElementById("download-pdf")
        .addEventListener("click", () => {
            const printableContent = this.document.getElementById("printableContent");
            console.log(printableContent);
            console.log(window);
            var opt = {
                margin: 0.2,
                filename: 'invoice.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            // html2pdf().from(printableContent).set(opt).save();

            html2pdf().from(printableContent).set(opt).outputPdf().then(function(pdf) {
              html2pdf().from(printableContent).set(opt).save();
          // Hide the button after the PDF is generated and saved
          document.getElementById("download-pdf").style.display = "none";
          document.getElementById("print").style.display = "none";
          setTimeout(function () {
            location.reload();
      }, 500);
        });
        
        })
}
</script>
@endsection

