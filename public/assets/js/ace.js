document.addEventListener('DOMContentLoaded', function () {
    // <------Category edit modal --------->
    const editCategoryModal = document.getElementById('editCategoryModal');
    const editCategoryForm = document.getElementById('editCategoryForm');
    const editNameInput = document.getElementById('editName');
    const modalTitle = editCategoryModal.querySelector('h1.modal-title');

    editCategoryModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const id = button.getAttribute('data-id'); // Ambil data-id
        const name = button.getAttribute('data-name'); // Ambil data-name

        // Ubah judul modal
        modalTitle.textContent = `Update Category ${name}`;

        // Ubah action URL pada form
        editCategoryForm.action = `/book-categories/${id}`;

        // Isi input name
        editNameInput.value = name;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const editBookModal = document.getElementById('editBookModal');
    const editBookForm = document.getElementById('editBookForm');
    const editTitleInput = document.getElementById('edit-title');
    const editAuthorInput = document.getElementById('edit-author');
    const editExcerptInput = document.getElementById('edit-excerpt');
    const editSynopsisInput = document.getElementById('edit-synopsis');
    const editPublisherInput = document.getElementById('edit-publisher');
    const editStockInput = document.getElementById('edit-stock');
    const editYearPublishedInput = document.getElementById('edit-yearPublished');
    const categorySelect = document.getElementById('category_id'); // Tambahkan ini
    const modalTitle = editBookModal.querySelector('h1.modal-title');

    editBookModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const slug = button.getAttribute('data-slug');
        const title = button.getAttribute('data-title');
        const author = button.getAttribute('data-author');
        const excerpt = button.getAttribute('data-excerpt');
        const publisher = button.getAttribute('data-publisher');
        const yearPublished = button.getAttribute('data-yearPublished');
        const synopsis = button.getAttribute('data-synopsis');
        const stock = button.getAttribute('data-stock');
        const category = button.getAttribute('data-category');

        modalTitle.textContent = `Update Book: ${title}`;

        editBookForm.action = `/books/${slug}`;

        editTitleInput.value = title;
        editAuthorInput.value = author;
        editExcerptInput.value = excerpt;
        editPublisherInput.value = publisher;
        editSynopsisInput.value = synopsis;
        editStockInput.value = stock;
        editYearPublishedInput.value = yearPublished;

        const options = categorySelect.options;
        for (let i = 0; i < options.length; i++) {
            if (options[i].value === category) {
                options[i].selected = true;
            } else {
                options[i].selected = false;
            }
        }
    });
});
document.addEventListener('DOMContentLoaded', function (){
    const editUserModal = document.getElementById('editUserModal');
    const editUserForm = document.getElementById('editUserForm');
    const modalTitle = editUserModal.querySelector('h1.modal-title');
    
    // Form fields
    const editNameInput = editUserModal.querySelector('#name');
    const editUsernameInput = editUserModal.querySelector('#username');
    const editPasswordInput = editUserModal.querySelector('#password');
    const editEmailInput = editUserModal.querySelector('#email');
    const editAddressInput = editUserModal.querySelector('#address');
    const editLevelSelect = editUserModal.querySelector('#level');

    editUserModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const id = button.getAttribute('data-id'); // Ambil data-id
        const name = button.getAttribute('data-name'); // Ambil data-name
        const username = button.getAttribute('data-username'); // Ambil data-username
        const email = button.getAttribute('data-email'); // Ambil data-email
        const address = button.getAttribute('data-address'); // Ambil data-address
        const level = button.getAttribute('data-level'); // Ambil data-level

        // Ubah judul modal
        modalTitle.textContent = `Update User: ${name}`;

        // Ubah action URL pada form
        editUserForm.action = `/users/${id}`;

        // Isi input fields
        editNameInput.value = name;
        editUsernameInput.value = username;
        editEmailInput.value = email;
        editAddressInput.value = address;
        editLevelSelect.value = level;
    });
});

// Loan Modal
document.addEventListener('DOMContentLoaded', function () {
    // Loan Request Modal
    const loanModal = document.getElementById('loanModal');
    const loanForm = document.getElementById('loanForm');

    loanModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang memicu modal
        const slug = button.getAttribute('data-slug');
        const title = button.getAttribute('data-title'); // Ambil data-title
        const author = button.getAttribute('data-author'); // Ambil data-author
        const publisher = button.getAttribute('data-publisher'); // Ambil data-author
        const synopsis = button.getAttribute('data-synopsis'); // Ambil data-author

        // Cari elemen untuk diisi dalam modal
        const modalTitleElement = loanModal.querySelector('.modal-title');
        const titleElement = loanModal.querySelector('#title');
        const authorElement = loanModal.querySelector('#author');
        const publisherElement = loanModal.querySelector('#publisher');
        const synopsisElement = loanModal.querySelector('#synopsis');

        loanForm.action = `/requestLoan/${slug}`;

        modalTitleElement.textContent = `Loan : ${title}`;
        titleElement.textContent = `Book Title: ${title}`;
        authorElement.textContent = `Author: ${author}`;
        publisherElement.textContent = `Publisher: ${author}`;
        synopsisElement.textContent = `${author}`;
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('#icon-stars i');
    const ratingInput = document.getElementById('rating');
    const emote = document.getElementById('emote');

    const emoteArray = [
        '😡 Wuelekkkkk',
        '😠 Elek',       
        '😐 Biasa Aja',  
        '😊 Baguss',       
        '🤩 Gacorrr Kang' 
    ];

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            ratingInput.value = index + 1;

            stars.forEach((s, i) => {
                s.classList.toggle('text-warning', i <= index);
            });
            emote.textContent = emoteArray[index];
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('#delete-loan-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const loanId = form.querySelector('input[name="loan_id"]').value;
            const status = this.getAttribute('data-status');
            let message = "";
            if(status === "proses"){
                message = "Apakah anda ingin cancel peminjaman?"
            } else if(status === "disetujui"){
                message = "Tidak bisa mengapus data selama masih peminjaman!"
            } else{
                message = "Apakah anda ingin menghapus data peminjaman?"
            }

            if(status === "disetujui"){
                Swal.fire({
                text: message,
                    icon: 'warning',
                    confirmButtonColor: '#3f51b5',
                    buttons: {
                      confirm: {
                        text: "OK",
                        value: null,
                        visible: true,
                        className: "btn btn-primary",
                        closeModal: true
                      }
                    }
                  });
            } else{
                Swal.fire({
                    title: 'Anda yakin?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3f51b5',
                    cancelButtonColor: '#ff4081',
                    confirmButtonText: 'Yes!',
                    cancelButtonText: 'No, Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.action = `/library/${loanId}/destroyUser`;
                        form.submit();
                    }
                });
            }
        });
    });
});
