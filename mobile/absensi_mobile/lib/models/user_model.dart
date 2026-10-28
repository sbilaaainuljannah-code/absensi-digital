class UserModel {
  final int id;
  final String name;
  final String email;
  final String role;
  final StudentModel? student;

  UserModel({required this.id, required this.name, required this.email, required this.role, this.student});

  factory UserModel.fromJson(Map<String, dynamic> json) => UserModel(
    id: json['id'] ?? 0,
    name: json['name'] ?? '-',
    email: json['email'] ?? '-',
    role: json['role'] ?? 'student',
    student: json['student'] is Map<String, dynamic> ? StudentModel.fromJson(json['student']) : null,
  );
}

class StudentModel {
  final int id;
  final String nis;
  final String nama;
  final String kelas;

  StudentModel({required this.id, required this.nis, required this.nama, required this.kelas});

  factory StudentModel.fromJson(Map<String, dynamic> json) => StudentModel(
    id: json['id'] ?? 0,
    nis: json['nis'] ?? '-',
    nama: json['nama'] ?? '-',
    kelas: (json['class_room']?['nama_kelas'] ?? json['classRoom']?['nama_kelas'] ?? '-') as String,
  );
}
