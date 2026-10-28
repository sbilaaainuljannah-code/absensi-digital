import 'dart:convert';
import 'package:http/http.dart' as http;
import 'storage_service.dart';

class ApiService {
  // Android Emulator: 10.0.2.2
  // HP fisik: ganti menjadi http://IP-KOMPUTER:8000/api
  static const String baseUrl = 'http://10.0.2.2:8000/api';

  static Future<Map<String, dynamic>> _decode(http.Response response) async {
    final body = response.body.isEmpty ? <String, dynamic>{} : jsonDecode(response.body) as Map<String, dynamic>;
    if (response.statusCode >= 400) {
      throw Exception(body['message'] ?? 'Request gagal (${response.statusCode})');
    }
    return body;
  }

  static Future<Map<String, dynamic>> login(String email, String password) async {
    final response = await http.post(Uri.parse('$baseUrl/login'), headers: {'Accept': 'application/json', 'Content-Type': 'application/json'}, body: jsonEncode({'email': email, 'password': password}));
    return _decode(response);
  }

  static Future<Map<String, dynamic>> me() async => _get('/me');
  static Future<Map<String, dynamic>> today() async => _get('/attendance/today');
  static Future<Map<String, dynamic>> history() async => _get('/attendance/history');

  static Future<Map<String, dynamic>> scan(String token, double latitude, double longitude) async {
    return _post('/attendance/scan', {'qr_token': token, 'latitude': latitude, 'longitude': longitude});
  }

  static Future<void> logout() async {
    final token = await StorageService.getToken();
    if (token != null) {
      await http.post(Uri.parse('$baseUrl/logout'), headers: {'Accept': 'application/json', 'Authorization': 'Bearer $token'});
    }
    await StorageService.clear();
  }

  static Future<Map<String, dynamic>> _get(String path) async {
    final token = await StorageService.getToken();
    final response = await http.get(Uri.parse('$baseUrl$path'), headers: {'Accept': 'application/json', 'Authorization': 'Bearer $token'});
    return _decode(response);
  }

  static Future<Map<String, dynamic>> _post(String path, Map<String, dynamic> data) async {
    final token = await StorageService.getToken();
    final response = await http.post(Uri.parse('$baseUrl$path'), headers: {'Accept': 'application/json', 'Content-Type': 'application/json', 'Authorization': 'Bearer $token'}, body: jsonEncode(data));
    return _decode(response);
  }
}
