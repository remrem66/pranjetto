@include('admin.header')
@include('admin.navbar')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales Report</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sales</h3>
            </div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-lg-12">

                  <div class="btn-group">
                    <button class="btn btn-primary" id="btnDaily">Daily</button>
                    <button class="btn btn-success" id="btnWeekly">Weekly</button>
                    <button class="btn btn-info" id="btnMonthly">Monthly</button>
                    
                  </div>

                </div>
              </div>
              <div class="row mb-2">
                <div class="col-lg-4">
                <form id="search_sales_date">
                  <input type="text" name="from_date" id="from_date" placeholder="From date" class="form-control" value="">
                  <input type="text" name="to_date" id="to_date" placeholder="To date" class="form-control" value="">
                  <button type="submit" class="btn btn-primary" id="searchSales">Search</button>
                </form>
                </div>
              </div>


              <table id="sales" class="table table-bordered table-striped">
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@include('admin.footer')