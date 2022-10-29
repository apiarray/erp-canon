  <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout');?>">Logout</a>
                </div>
            </div>
        </div>
    </div>  
  
  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/dark-mode-switch.min.js"></script>
  <script src="assets/vendor/dark-mode-switch.js"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/js/sb-admin-2.min.js');?>"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/vendor/chart.js/Chart.min.js');?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/js/demo/chart-area-demo.js');?>"></script>
  <script src="<?= base_url('assets/js/demo/chart-pie-demo.js');?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('assets/js/demo/datatables-demo.js');?>"></script>

  <!-- <script>
    // Container bagian bawah
    const bottomElement = document.querySelector('.container-bottom');
    const expander = document.querySelector('.expander');
    expander.addEventListener('click', function() {
      bottomElement.classList.toggle('expand');
      if (bottomElement.classList.contains('expand')) {
        expander.classList.remove('animate');
        expander.classList.add('rotator');
      } else {
        expander.classList.remove('rotator');
        expander.classList.add('animate');
      }
    });
  </script> -->

</body>

</html>