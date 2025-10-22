

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Get subcategories based on category selection
        function getSubcategories(category) {
            if (!category) {
                document.getElementById('subcategory').innerHTML = '<option value="">Select Subcategory</option>';
                return;
            }

            fetch('<?= base_url("admin/products/get_subcategories") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'category=' + category
            })
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Select Subcategory</option>';
                data.forEach(item => {
                    options += `<option value="${item.name}">${item.name.charAt(0).toUpperCase() + item.name.slice(1)}</option>`;
                });
                document.getElementById('subcategory').innerHTML = options;
            });
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('show')) {
                    alert.classList.remove('show');
                }
            });
        }, 5000);
    </script>
<!-- </body>
</html> -->