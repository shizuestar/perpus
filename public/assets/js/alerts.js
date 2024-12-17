(function($) {
  showSwal = function(type, message) {
    'use strict';
    if (type === 'basic') {
      Swal.fire({
        text: 'Any fool can use a computer',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    } else if (type === 'title-and-text') {
      Swal.fire({
        title: 'Read the alert!',
        text: 'Click OK to close this alert',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    } else if (type === 'success-message') {
      Swal.fire({
        title: 'Succes!',
        text: message,
        icon: 'success',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    } else if (type === 'auto-close') {
      Swal.fire({
        title: 'Auto close alert!',
        text: 'I will close in 2 seconds.',
        timer: 2000,
        button: false
      }).then(
        function() {},
        // handling the promise rejection
        function(dismiss) {
          if (dismiss === 'timer') {
            console.log('I was closed by the timer')
          }
        }
      )
    } else if (type === 'warning-message-and-cancel') {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Yes, do it!', // Teks tombol confirm
        cancelButtonText: 'No, cancel!',  // Teks tombol cancel
      }).then((result) => {
        if (result.isConfirmed) {
          const data = `#delete-${message}`;
          document.querySelector(data).submit();
      }
      });
    } else if (type === 'custom-html') {
      Swal.fire({
        content: {
          element: "input",
          attributes: {
            placeholder: "Type your password",
            type: "password",
            class: 'form-control'
          },
        },
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })
    } else if(type === "warning-message"){
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
    } else if(type === "eror-message"){
      Swal.fire({
        icon: "error",
        title: "Oops",
        text: message,
      });
    } else if (type === 'warning-message-and-cancel-login') {
      Swal.fire({
        title: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Yes, Login!', // Teks tombol confirm
        cancelButtonText: 'No, cancel!',  // Teks tombol cancel
      }).then((result) => {
        if (result.isConfirmed) {
          // Arahkan ke route login setelah klik "Yes"
          window.location.href = "/login";
        }
      });
    } else if (type === 'warning-message-and-cancel-fav') {
      Swal.fire({
        title: 'Anda Yakin?',
        text: "Yakin ingin menghapus buku dari koleksi?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Yes, do it!', // Teks tombol confirm
        cancelButtonText: 'No, cancel!',  // Teks tombol cancel
      }).then((result) => {
        if (result.isConfirmed) {
          const data = `#delete-${message}`;
          document.querySelector(data).submit();
      }
      });
    }
    
  }

})(jQuery);