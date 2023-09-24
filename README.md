## LPS .NET DEVELOPER PROGRAMMING SKILL TEST

#### Question A

Environment:
- PHP: 7.4
- Database: SQL Server

Step 1 Database:
- create database dengan nama exam di sql server
- copy isi file database.sql ke sql query kemudian execute

Step 2 Install Server:
- cd server
- edit file .env sesuaikan dengan koneksi database sql server
- composer install
- php -S localhost:9999

Step 3 Test Postman:
- download exam.postman_collection.json
- buka postman kemudian import collectionnya


#### Dart Compiler Online 
Untuk Question B sampai E gunakan dart compiler dibawah ini untuk menjalankan
```
https://www.tutorialspoint.com/execute_dart_online.php
```
#### Question B
```
import 'dart:io';

void main() {
    //print to screen
    print("Enter 1.225.441 or else?");
    //get user input
    String input = stdin.readLineSync()!;
    //validate user input
    if(isValid(input)) {
        //remove blank space
        input = input.replaceAll('.','');
        //get input length
        var length = input.length;
        //loop string
        for(var i = 0; i<length; i++) {
            //print input and add 0 x length character after index
            print(input[i].padRight(length - i,'0'));
        }
    } else {
        //print if user input blank space
        print('Invalid input');
    }
}
//function validate input
bool isValid(String s) {
    //regex only number and dot
    final regex = RegExp(r'^\d+(\.\d+)*$');
    //if string match with regex return true
    return regex.hasMatch(s);
}
```

#### Question C
```
import 'dart:io';

void main() {
    //print to screen
    print("Enter hello world or else?");
    //get input user
    String str = stdin.readLineSync()!;
    //remove all space
    str = str.replaceAll(' ','');
    //check str is not empty string
    if(str.isNotEmpty) {
        //create map variable
        Map<String, int> map = {};
        //loop string
        for(int i = 0; i < str.length; i++) {
            //count string, if nothing give zero
            int count = map[str[i]] ?? 0;
            //append count to map
            map[str[i]] = count + 1;
        }
        //print key : value
        map.forEach((k, v) => print("$k : $v"));
    } else {
        //print if user input blank space
        print('Invalid input');
    }
}
```

#### Question D
```
import 'dart:io';

void main() {
    //print to screen
    print("Enter N number?");
    //get input user
    String n = stdin.readLineSync()!;
    //check input is valid
    if(isValid(n)) {
        //loop n
        for(int i = 1; i <= int.parse(n); i++) {
            //print IDIC if input multiple 5 but not 5 it self
            //print LPS if input multiple 6 but not 6 it self
            print((i != 5 && i % 5 == 0) ? "IDIC" : (i != 6 && i % 6 == 0) ? "LPS" : i);
        }
    } else {
        //print invalid input
        print('Invalid input');
    }
}
//function validate input
bool isValid(String input) {
    //input not starting with 0 num
    if(input.startsWith('0')) {
        return false;
    }
    //regex only number
    final regex = RegExp(r'^[0-9]+$');
    //if input match with regex return true
    return regex.hasMatch(input);
}
```

#### Question E
```
import 'dart:io';

void main() {
    //print to screen
    print("Enter character?");
    //get input user
    String input = stdin.readLineSync()!;
    //print to screen
    print('Output :');
    print('Format Judul: '+input.toTitleCase());
    print('Format Biasa: '+input.toCapitalized());
}

extension StringCasingExtension on String {
    //capital on first string
    String toCapitalized() => length > 0 ?'${this[0].toUpperCase()}${substring(1).toLowerCase()}':'';
    //capital on first sentences
    String toTitleCase() => replaceAll(RegExp(' +'), ' ').split(' ').map((str) => str.toCapitalized()).join(' ');
}
```
