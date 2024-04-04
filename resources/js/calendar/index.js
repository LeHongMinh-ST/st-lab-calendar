window.addEventListener('openDeleteModal', () => {
    new swal({
        title: "Bạn có chắc chắn?",
        text: "Dữ liệu sau khi xóa không thể phục hồi!",
        showCancelButton: true,
        confirmButtonColor: "#FF7043",
        confirmButtonText: "Đồng ý!",
        cancelButtonText: "Đóng!"
    }).then((value) => {
        if (value.isConfirmed) {
            Livewire.dispatch('deleteCalendar')
        }
    })
})

window.addEventListener('openApproveModal', () => {
    new swal({
        title: "Chọn trạng thái muốn phê duyệt?",
        input: 'select',
        inputOptions: {
            'active': 'Kích hoạt',
            'draft': 'Hủy',
        },
        inputPlaceholder: 'Chọn trạng thái',
        showCancelButton: true,
        confirmButtonText: "Đồng ý!",
        cancelButtonText: "Đóng!"
    }).then((value) => {
        if (value.isConfirmed) {
            console.log(value.value)
            Livewire.dispatch('approveCalendar', {status: value.value})
        }
    })
})
