// function cari_pelanggan(idHotel, namaHotel) {
//   Swal.fire({
//     title: "<h2>Pilih Pelanggan</h2>",
//     width: "800px",
//     heightAuto: false, // biar tinggi bisa kita kontrol
//     customClass: {
//       popup: "custom-height custom-padding", // kasih class tambahan
//       htmlContainer: "my-html",
//     },
//     html: `
//       <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
//         <li class="nav-item" role="presentation">
//           <button class="nav-link active" id="cari-tab" data-bs-toggle="tab" data-bs-target="#cari" type="button" role="tab">Cari Pelanggan</button>
//         </li>
//         <li class="nav-item" role="presentation">
//           <button class="nav-link" id="form-tab" data-bs-toggle="tab" data-bs-target="#form" type="button" role="tab">Tambah Baru</button>
//         </li>
//       </ul>
//       <div class="tab-content mt-2">
//         <div class="tab-pane fade show active" id="cari" role="tabpanel">
//           <div class='border border-secondary rounded p-2'>
//             <table class='table table-sm mb-2'>
//               <tr>
//                 <td width='40%'>Nama/No WA Pelanggan</td>
//                 <td width='1%'>:</td>
//                 <td width='59%'><input type="text" name="search" id="search" class='form-control form-control-sm'></td>
//               </tr>
//             </table>
//             <div class='table table-responsive'>
//               <table class='table table-striped table-sm mb-0'>
//                 <thead>
//                   <th>Nama</th>
//                   <th>Jenis Kelamin</th>
//                   <th>No HP</th>
//                   <th>Aksi</th>
//                 </thead>
//                 <tbody id='results'></tbody>
//               </table>
//             </div>
//           </div>
//         </div>
//         <div class="tab-pane fade" id="form" role="tabpanel">
//           <div class='border border-secondary rounded p-2'>
//             <form method='post' id='simpan_baru'>
//               <table class='table table-sm mb-2'>
//                 <tr>
//                   <td>Nama</td>
//                   <td><input type='text' id='nama_baru' name='nama_baru' class='form-control form-control-sm'></td>
//                 </tr>
//                 <tr>
//                   <td>Jenis Kelamin</td>
//                   <td>
//                     <select class='form-control form-control-sm' name='jenis_kelamin' id='jenis_kelamin'>
//                       <option value='Laki-Laki'>Laki-Laki</option>
//                       <option value='Perempuan'>Perempuan</option>
//                     </select>
//                   </td>
//                 </tr>
//                 <input type='hidden' name='id_hotel' value='${idHotel}'>
//                 <tr>
//                   <td>No HP</td>
//                   <td><input type='text' id='hp_baru' name='hp_baru' class='form-control form-control-sm'></td>
//                 </tr>
//               </table>
//               <button class='btn btn-success btn-sm' type='button' id='btn_simpan'><i class='fa fa-save'></i> Simpan Pelanggan</button>
//             </form>
//           </div>
//         </div>
//       </div>
//     `,
//     showConfirmButton: false,
//     showCancelButton: false,
//     didOpen: () => {
//       const input = document.getElementById("search");
//       const results = document.getElementById("results");
//       const id_pelanggan = document.getElementById("id_pelanggan");
//       const simpan_baru = document.getElementById("simpan_baru");
//       const btn_simpan = document.getElementById("btn_simpan");

//       function renderResults(result) {
//         if (result == "null") {
//           results.innerHTML = '<tr><td colspan="4">Tidak Ditemukan</td></tr>';
//         } else {
//           results.innerHTML = "";
//           result.forEach(function (element) {
//             results.innerHTML += `
//               <tr>
//                 <td>${element.nama}</td>
//                 <td>${element.jenis_kelamin}</td>
//                 <td>${element.no_hp}</td>
//                 <td><button class='btn btn-sm btn-primary pil_pelanggan' data-id='${element.id}' data-name='${element.nama}'>Pilih</button></td>
//               </tr>`;
//           });
//         }
//       }

//       // load 10 pelanggan terbaru
//       fetch("find_pelanggan.php", {
//         method: "POST",
//         body: JSON.stringify({ name: "", id_hotel: idHotel }),
//       })
//         .then((response) => response.json())
//         .then((result) => renderResults(result))
//         .catch((error) => console.error(error));

//       // pencarian realtime
//       input.addEventListener("keyup", () => {
//         fetch("find_pelanggan.php", {
//           method: "POST",
//           body: JSON.stringify({ name: input.value, id_hotel: idHotel }),
//         })
//           .then((response) => response.json())
//           .then((result) => renderResults(result))
//           .catch((error) => console.error(error));
//       });

//       // pilih pelanggan
//       results.addEventListener("click", function (e) {
//         if (e.target && e.target.classList.contains("pil_pelanggan")) {
//           const id_pel = e.target.getAttribute("data-id");
//           const name_pel = e.target.getAttribute("data-name");
//           id_pelanggan.innerHTML = `<option value='${id_pel}'>${name_pel}</option>`;
//           Swal.close();
//         }
//       });

//       // simpan pelanggan baru
//       btn_simpan.addEventListener("click", function () {
//         const dataform = new FormData(simpan_baru);
//         fetch("./simpan_pelanggan_v2.php", { method: "POST", body: dataform })
//           .then((response) => response.json())
//           .then((data) => {
//             if (data !== "false") {
//               id_pelanggan.innerHTML = `<option value='${data[0]}'>${data[1]}</option>`;
//               Swal.close();
//             }
//           })
//           .catch((error) => console.error(error));
//       });
//     },
//   });
// }
