import 'package:flutter/material.dart';
import 'screens/login_screen.dart';
import 'screens/dashboard_screen.dart';
import 'services/storage_service.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  runApp(const AbsensiApp());
}

class AbsensiApp extends StatelessWidget {
  const AbsensiApp({super.key});

  @override
  Widget build(BuildContext context) {
    const navy = Color(0xFF071321);
    const blue = Color(0xFF66C8FF);
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Absensi Digital',
      theme: ThemeData(
        brightness: Brightness.dark,
        scaffoldBackgroundColor: navy,
        colorScheme: ColorScheme.fromSeed(seedColor: blue, brightness: Brightness.dark),
        fontFamily: 'Arial',
        inputDecorationTheme: InputDecorationTheme(
          filled: true,
          fillColor: const Color(0xFF0D2035),
          border: OutlineInputBorder(borderRadius: BorderRadius.circular(14), borderSide: const BorderSide(color: Color(0xFF1E4564))),
          enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(14), borderSide: const BorderSide(color: Color(0xFF1E4564))),
          focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(14), borderSide: const BorderSide(color: blue)),
        ),
      ),
      home: const SplashGate(),
    );
  }
}

class SplashGate extends StatefulWidget {
  const SplashGate({super.key});
  @override
  State<SplashGate> createState() => _SplashGateState();
}

class _SplashGateState extends State<SplashGate> {
  @override
  void initState() {
    super.initState();
    _go();
  }

  Future<void> _go() async {
    await Future.delayed(const Duration(milliseconds: 850));
    final token = await StorageService.getToken();
    if (!mounted) return;
    Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (_) => token == null ? const LoginScreen() : const DashboardScreen()));
  }

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      body: Center(child: Column(mainAxisSize: MainAxisSize.min, children: [
        _Logo(), SizedBox(height: 18), Text('ABSENSI DIGITAL', style: TextStyle(fontSize: 22, fontWeight: FontWeight.w800, letterSpacing: 1.4)), SizedBox(height: 6), Text('Smart Attendance System', style: TextStyle(color: Color(0xFF7896AE), fontSize: 12)), SizedBox(height: 28), CircularProgressIndicator(strokeWidth: 2),
      ])),
    );
  }
}

class _Logo extends StatelessWidget {
  const _Logo();
  @override
  Widget build(BuildContext context) => Container(width: 66, height: 66, decoration: BoxDecoration(borderRadius: BorderRadius.circular(21), gradient: const LinearGradient(colors: [Color(0xFF8FE0FF), Color(0xFF3C83DD)]), boxShadow: const [BoxShadow(color: Color(0x335CB9FF), blurRadius: 28)]), alignment: Alignment.center, child: const Text('A', style: TextStyle(color: Color(0xFF061321), fontSize: 30, fontWeight: FontWeight.w900)));
}
