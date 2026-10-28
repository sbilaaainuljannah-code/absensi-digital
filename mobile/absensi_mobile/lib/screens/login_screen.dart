import 'package:flutter/material.dart';
import '../services/api_service.dart';
import '../services/storage_service.dart';
import 'dashboard_screen.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});
  @override State<LoginScreen> createState() => _LoginScreenState();
}
class _LoginScreenState extends State<LoginScreen> {
  final email = TextEditingController(text: 'budi@absensi.test');
  final password = TextEditingController(text: 'password');
  bool loading = false;
  bool obscure = true;

  Future<void> submit() async {
    setState(() => loading = true);
    try {
      final result = await ApiService.login(email.text.trim(), password.text);
      await StorageService.saveToken(result['data']['token']);
      if (!mounted) return;
      Navigator.of(context).pushReplacement(MaterialPageRoute(builder: (_) => const DashboardScreen()));
    } catch (e) {
      if (mounted) ScaffoldMessenger.of(context).showSnackBar(SnackBar(content: Text(e.toString().replaceFirst('Exception: ', ''))));
    } finally { if (mounted) setState(() => loading = false); }
  }

  @override Widget build(BuildContext context) => Scaffold(body: SafeArea(child: Center(child: SingleChildScrollView(padding: const EdgeInsets.all(26), child: ConstrainedBox(constraints: const BoxConstraints(maxWidth: 430), child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [
    Center(child: Container(width: 70,height:70,alignment:Alignment.center,decoration:BoxDecoration(borderRadius:BorderRadius.circular(22),gradient:const LinearGradient(colors:[Color(0xFF8FE0FF),Color(0xFF3B82DA)])),child:const Text('A',style:TextStyle(color:Color(0xFF061321),fontSize:32,fontWeight:FontWeight.w900)))),
    const SizedBox(height:30), const Text('Selamat datang',style:TextStyle(fontSize:28,fontWeight:FontWeight.w800)), const SizedBox(height:7), const Text('Login sebagai siswa untuk membuka dashboard dan absensi.',style:TextStyle(color:Color(0xFF829DB5))), const SizedBox(height:28),
    TextField(controller:email,keyboardType:TextInputType.emailAddress,decoration:const InputDecoration(labelText:'Email',prefixIcon:Icon(Icons.mail_outline))), const SizedBox(height:14),
    TextField(controller:password,obscureText:obscure,decoration:InputDecoration(labelText:'Password',prefixIcon:const Icon(Icons.lock_outline),suffixIcon:IconButton(onPressed:()=>setState(()=>obscure=!obscure),icon:Icon(obscure?Icons.visibility_outlined:Icons.visibility_off_outlined)))), const SizedBox(height:20),
    SizedBox(width:double.infinity,height:50,child:ElevatedButton(onPressed:loading?null:submit,style:ElevatedButton.styleFrom(backgroundColor:const Color(0xFF62C7FF),foregroundColor:const Color(0xFF061321),shape:RoundedRectangleBorder(borderRadius:BorderRadius.circular(14))),child:loading?const SizedBox(width:20,height:20,child:CircularProgressIndicator(strokeWidth:2)):const Text('Masuk',style:TextStyle(fontWeight:FontWeight.w800)))), const SizedBox(height:18),
    const Center(child:Text('Demo: budi@absensi.test / password',style:TextStyle(color:Color(0xFF637E97),fontSize:11))),
  ])))));
}
