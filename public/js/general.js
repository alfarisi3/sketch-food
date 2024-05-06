window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 3000);


function deleteData(dataId) {
    Swal.fire({
        title: "Anda yakin ingin menghapus?",
        text: "Data yang di hapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed)
        {
            $('#deleteForm' + dataId).submit();
        }
    });
}
