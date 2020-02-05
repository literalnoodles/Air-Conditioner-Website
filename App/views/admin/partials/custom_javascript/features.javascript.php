<script src="/plugins/toastr/toastr.js"></script>
<script src='/plugins/DataTables/datatables.js'></script>
<script>
	$(document).ready(function() {
		Load();
	});

	function Load() {
		$.ajax({
			url: "/admin/ajax_process?type=features",
			type: "POST",
			success: function(result, status, xhr) {
				var table = $('#tbl_brands').DataTable();
				//[{"feature_id":"16","feature_name":"fas","description":""}]
				table.clear();
				if (!result) {
					table.draw();
					return;
				}
				var arr = JSON.parse(result);
				for (var i = 0; i < arr.length; i++) {
					table.row.add([
						arr[i].feature_id,
						arr[i].feature_name,
						(arr[i].description === null ? "" : arr[i].description),
						(`<a class="btn" role="button" href="#" onclick="get(${arr[i].feature_id})">
                				<i class="fa fa-edit"></i>
                			</a>
                			<a class="btn" role="button" href="#" onclick="Delete(${arr[i].feature_id})">
                				<i class="fa fa-trash"></i>
                			</a>`)
					]);
				}
				table.draw();
			}
		});
	}

	function Add() {
		//reset the form
		$("#btnSave").attr("onclick", "Save()").html("Save");
		$("#FeatureName").val("");
		$("#Description").val("");
		//show the form
		$('#myModal').modal('show');
		$("#modal-title").text("Add feature");
	}

	function get(id) {
		$("#btnSave").attr("onclick", `update(${id})`).html("Edit");
		$.ajax({
			url: "/admin/ajax_process?type=features&action=get&feature_id=" + id,
			type: "POST",
			success: function(result, status, xhr) {
				var arr = JSON.parse(result);
				$("#FeatureName").val(arr[0].feature_name);
				$("#Description").val(arr[0].description);
			},
			error: function(xhr, status, error) {
				toastr.error('', 'Request fail!');
			}
		});
		$('#myModal').modal('show');
		$("#modal-title").text("Update feature");
	}

	function update(id) {
		var data = {
			"feature_id": id,
			"feature_name": $("#FeatureName").val(),
			"description": $("#Description").val()
		};
		$.ajax({
			url: "/admin/ajax_process?type=features&action=update",
			type: "POST",
			data: data,
			success: function(result, status, xhr) {
				console.log(result);
				if (result == "success") {
					toastr.success('', 'Update successfully!');
				} else {
					toastr.error('', 'Update fail!');
				}
				$('#myModal').modal('toggle');
				Load();
			},
			error: function(xhr, status, error) {
				toastr.error('', 'Request fail!');
			}
		});
	}

	function Delete(id) {
		if (confirm("Are you sure to delete?")) {
			$.ajax({
				// need to set async to false because sometime it causes bug in datatable
				async: false,
				url: "/admin/ajax_process?type=features&action=delete&feature_id=" + id,
				type: "POST",
				success: function(result, status, xhr) {
					if (result == "success") {
						toastr.success('', 'Delete successfully!');
					} else {
						toastr.error('', 'Delete fail!');
					}
				},
				error: function(xhr, status, error) {
					toastr.error('', 'Request fail!');
				}
			});
			Load();
		}
	}

	function Save() {
		var feature_name = $("#FeatureName").val();
		var description = $("#Description").val();
		var data = {
			feature_name,
			description
		};
		$.ajax({
			url: "/admin/ajax_process?type=features&action=insert",
			type: "POST",
			data: data,
			success: function(result, status, xhr) {
				if (result == "success") {
					toastr.success('', 'Update successfully!');
				} else {
					toastr.error('', 'Update fail!');
				}
				$('#myModal').modal('toggle');
				Load();
			},
			error: function(xhr, status, error) {
				toastr.error('', 'Request fail!');
			}
		});
	}
</script>