<template>
  <div class="row">

    <div  class="col-12 col-sm-6 col-md-4 col-lg-3 top-badges">
      <a href="/dashboard/orders-inprogress">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"
            ><i class="fas fa-clock"></i
          ></span>

          <div class="info-box-content">
            <span class="info-box-text">In progress</span>
            <span class="info-box-number">
              {{$page.props.monthlySmsCount}}50
              <small>This month</small>
            </span>
          </div>
        </div>
      </a>
    </div>

    <div  class="col-12 col-sm-6 col-md-4 col-lg-3 top-badges">
      <a href="/dashboard/refunds">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"
            ><i class="fas fa-money-bill"></i
          ></span>

          <div class="info-box-content">
            <span class="info-box-text">Refunds</span>
            <span class="info-box-number">
              5
              <small>This month</small>
            </span>
          </div>
        </div>
      </a>
    </div>

    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 top-badges">
      <a href="/dashboard/orders-complete">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"
            ><i class="fas fa-check-circle"></i
          ></span>

          <div class="info-box-content">
            <span class="info-box-text">Complete</span>
            <span class="info-box-number">
              11
              <small>This month</small>
            </span>
          </div>
        </div>
      </a>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 top-badges">
      <a href="/dashboard/orders">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"
            ><i class="fas fa-file-alt"></i
          ></span>

          <div class="info-box-content">
            <span class="info-box-text">New</span>
            <span class="info-box-number">
              10
              <small>This month</small>
            </span>
          </div>
        </div>
      </a>
    </div>


  </div>
</template>

<script>
export default {};
</script>

<style>
</style>