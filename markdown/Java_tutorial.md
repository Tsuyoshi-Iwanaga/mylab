## Javaの動作環境
```java
JDK → Java Developer Kit
JRE → Java Runtime Environment
JVM → Java Viurtual Machine
```
## データ型
```java
public class MyApp {

  public static void main(String[] args) {
    // 文字
    char a = 'a';
    // 整数 byte short int long
    int x = 10;
    long y = 5555555555L;
    // 浮動小数点数 float double
    double d = 23423.344;
    float f = 32.33F;
    // 論理値
    boolean flag = true; // false
    // 文字列
    // \n
    // \t
    String msg = "Hello Wo\nrld Again\t!";
    System.out.println(msg);
  }
}
```
## 演算
```java
public class MyApp {

  public static void main(String[] args) {
    // 演算
    // + - * / %
    // ++ --
    // int i;
    // i = 10 / 3;
    // System.out.println(i); // 3
    // i = 10 % 3;
    // System.out.println(i); // 1
    // int x = 5;
    // x++;
    // System.out.println(x); // 6
    // x--;
    // System.out.println(x); // 5

    // int x = 5;
    // // x = x + 12;
    // x += 12;
    // System.out.println(x);

    String s;
    s = "hello " + "world";
    System.out.println(s);
  }
}
```
## 型変換
```java
public class MyApp {

  public static void main(String[] args) {
    // キャスト
    // double d = 52343.231;
    // int i = (int)d;
    // System.out.println(i);

    int i = 10;
    double d = (double)i / 4;
    System.out.println(d);
  }
}
```
## if文
```java
public class MyApp {

  public static void main(String[] args) {
    // if
    // > >= < <= == !=
    // && || !
    int score = 95;
    // if (score > 80) {
    //   System.out.println("Great!");
    // } else if (score > 60) {
    //   System.out.println("Good!");
    // } else {
    //   System.out.println("so so ... !");
    // }
    String msg = score > 80 ? "Great!" : "so so ... !";
    System.out.println(msg);
  }
}
```
## switch文
```java
public class MyApp {

  public static void main(String[] args) {
    // switch
    String signal = "green";
    switch (signal) {
      case "red":
        System.out.println("stop!");
        break;
      case "blue":
      case "green":
        System.out.println("go!");
        break;
      case "yellow":
        System.out.println("caution!");
        break;
      default:
        System.out.println("wrong signal!");
        break;
    }
  }
}
```
## while文
```java
public class MyApp {

  public static void main(String[] args) {
    // while
    // 0 - 9
    int i = 100;
    // while (i < 10) {
    //   System.out.println(i);
    //   i++;
    // }
    do {
      System.out.println(i);
      i++;
    } while (i < 10);
  }

}
```
## for文
```java
public class MyApp {

  public static void main(String[] args) {
    // for
    // 0 - 9
    // break
    // continue
    for (int i = 0; i < 10; i++) {
      if (i == 5) {
        // break;
        continue;
      }
      System.out.println(i);
    }
  }

}
```
## 配列
```java
public class MyApp {
  public static void main(String[] args) {
    // 配列
    // sales1, sales2, ...
    // sales

    // int[] sales;
    // sales = new int[3];

    // int[] sales;
    // sales = new int[] {100, 200, 300};

    int[] sales = {100, 200, 300};

    // sales[0] = 100;
    // sales[1] = 200;
    // sales[2] = 300;
    System.out.println(sales[1]); // 200
    sales[1] = 1000;
    System.out.println(sales[1]); // 1000
  }
}
```
## 配列の操作
```java
public class MyApp {
    public static void main(String[] args) {
        //sales.length
        int[] sales = {700, 400, 500};
        
        //for (int i = 0; i < sales.length; i++) {
        //	System.out.println(sales[i]);    
        //}
        
        for (int sale : sales) {
            System.out.println(sale);
        }
    }
}
```
## 基本データ型と参照
```java
public class MyApp {
    public static void main(String[] args) {
        //int x = 10;
        //int y = x;
        //y = 5;
        //System.out.println(x);
        //System.out.println(y);
        
        //int[] a = {3, 5, 7};
        //int[] b = a;
        //b[1] = 8;
        //System.out.println(a[1]);
        //System.out.println(b[1]);
        
        String s = "hello";
        String t = s;
        t = "world";
        System.out.print(s);
        System.out.print(t);
    }
}
```
## メソッド
```java
public class MyApp {
    
    //public static void sayHi() {
    //public static void sayHi(String name) {
    public static String sayHi(String name) {
        //System.out.println("hi");
        //System.out.println("hi" + name);
        return "hi" + name;
    }
    
    public static void main(String[] args) {
        //sayHi();
        //sayHi("Tom");
        //sayHi("Bob");
        String msg = sayHi("Steve");
        System.out.println(msg);
    }
}
```
## メソッドのオーバーライド
```java
public class MyApp {
    public static void sayHi(String name) {
        // int x = 10;
        System.out.println("hi" + name);
    }
    
    //override
    public static void sayHi() {
        System.out.println("hi! Nobady");
    }
    
    public static void main(String[] args) {
        sayHi();
        sayHi("Steve");
        // System.out.println(name);
        // System.out.println(x);
    }
}
```
## クラス
```java
class User {
    string name = "Me!";
    
    void sayHi() {
        System.out.println("hi");
    }
}

public class MyApp {
    public static void main(String[] args) {
        //int x;
        //String s;
        User tom;
        tom = new User();
        System.out.println(tom.name);
        tom.sayHi();
    }
}
```
## コンストラクタ
```java
class User {
    String name;
    
    User(String name) {
        this.name = name;
    }
    
    User() {
        this("Me!");
    }
    
    void sayHi() {
        System.out.println("hi" + this.name);
    }
}

public class MyApp {
    public static void main(String[] args) {
        User tom;
        //tom = new User("Tom");
        tom = new User();
        System.out.println(tom.name);
        tom.sayHi();
    }
}
```
## 継承
```java
class User {
    String name;
    
    User (String name) {
        this.name = name;
    }
    
    void sayHi() {
        System.out.println("hi" + this.name);
    }
}

class AdminUser extends User {
    AdminUser(String name) {
        super(name);
    }
    
    void sayHello() {
        System.out.println("hello" + this.name);
    }
    
    @Override
    void sayHi() {
        System.out.println("[admin] hi!" + this.name);
    }
}

public class MyApp {
    public static void main(String[] args) {
        User tom = new User("tom");
        System.out.println(tom.name);
        tom.sayHi();
        
        AdminUser bob = new AdminUser("bob");
        System.out.println(bob.name);
        bob.sayHi();
        bob.sayHello();
    }
}
```
## パッケージ
```java
package com.dotinstall.myapp;
import com.dotinstall.myapp.model.User;
import com.dotinstall.myapp.model.AdminUser;

public class MyApp {
    public static void main(String[] args) {
        User tom = new User("tom");
        System.out.println(tom.name);
        tom.sayHi();
        
        AdminUser bob = new AdminUser("bob");
        System.out.println(bob.name);
        bob.sayHi();
        bob.sayHello();
    }
}
```
```java
package com.dotinstall.myapp.model;

public class AdminUser extends User {
    public AdminUser(String name) {
        super(name);
    }
    
    public void sayHello() {
        System.out.println("hello" + this.name);
    }
    
    @Override
    public void sayHi() {
        System.out.println("[admin] hi!" + this.name);
    }
}
```
```java
package com.dotinstall.myapp.model;

class User {
    protected String name;
    
    public User(String name) {
        this.name = name;
    }
    
    public void sayHi() {
        System.out.println("hi!" + this.name);
    }
}
```
## ゲッタ、セッタ
```java
class User {
    private String name;
    private int score;
    
    public User(String name, int score) {
        this.name = name;
        this.score = score;
	}
    
    public int getScore() {
        return this.score;
    }
    
    public void setScore(int score) {
        if (score > 0) {
            this.score = score;
        }
    }
}

public class MyApp {
    public static void main(String[] args) {
        User tom = new User("tom", 65);
        tom.setScore(85);
        tom.setScore(-22);
        System.out.println(tom.getScore());
    }
}
```
## static
```java
class User {
    private String name;
    private static int count = 0;
    
    public User(String name) {
        this.name = name;
        User.count++;
	}
    
    public static void getInfo() {
        System.out.println("# of instances:" + User.count);
	}
}

public class MyApp {
    public static void main(String[] args) {
        User.getInfo();
        User tom = new User("tom");
        User.getInfo();
        User bob = new User("bob");
        User.getInfo();
    }
}
```
## イニシャライザ

```java
//static

class User {
    private String name;
    private static int count;
    
    static {
        User.count = 0;
        System.out.println("Static initializer");
    }
    
    {
        System.out.println("Instance initializer");
    }
    
    public User(String name) {
        this.name = name;
        User.count++;
        System.out.println("Constructor");
	}
    
    public static void getInfo() {
        System.out.println("# of instance:" + User.count);
	}
}

public class MyApp {
    public static void main(String[] args) {
        User.getInfo();
        User tom = new User("tom");
        User.getInfo();
        User bob = new User("bob");
        User.getInfo();
    }
}
```
## final
```java
final class User {
    protected String name;
    private static final double VERSION = 1.1;
    
    public User(String name) {
        this.name = name;
        user.VERSION = 1.2;
    }
    
    public final void sayHi() {
        System.out.println("hi" + this.name);
    }
}

class AdminUser extends User {
    public AdminUser(String name) {
        System.out.println("[admin] hi" + this.name);
    }
}

public class MyApp {
    public static void main(String[] args) {
        User tom = new User("tom");
    }
}
```
## 抽象クラス
```java
abstract class User {
    public abstract void sayHi();
}

class JapaneseUser extends User {
    @Override
    public void sayHi() {
        System.out.println("こんにちは");
	}
}

class AmericanUser extends User {
    @override
    public void sayHi() {
        System.out.println("Hi");
    }
}
```
## interface
```java
//interface

interface Printable {
    double VERSION = 1.2;
    void print();
    public default void getInfo() {
        System.out.print("I/F ver." + Printable.VERSION);
    }
}

class User implements Printable {
    @Override
    public void print() {
        System.out.println("Now printing user profile...");
    }
}

public class MyApp {
    public static void main(Stirng[] args) {
        User tom = new User();
        tom.print();
        tom.getInfo();
    }
}
```
## 列挙型
```java
enum Result {
    SUCCESS,
    ERROR,
}

public class MyApp {
    public static void main(String[] args) {
        Result res;
        
        res = Result.ERROR;
        
        switch (res) {
            case SUCCESS:
                System.out.println("OK");
                System.out.println(res.ordinal());
                break;
            case ERROR:
                System.out.pirntln("NG!");
                System.out.println(res.ordinal());
                break;
		}
	}
}
```
## 例外処理
```java
class MyException extends Exception {
    public MyException(String s) {
        super(s);
    }
}

public class MyApp {
    public static void div(int a, int b) {
        try{
            if(b < 0) {
                throw new MyException("not minus!");
            }
            System.out.println(a / b);
        } catch (ArithmethicException e) {
            System.err.println(e.getMessage());
        } catch (MyException e) {
            System.err.println(e.getMessage());
		} finally {
            System.out.println(" -- end -- ");
		}
	}
    
    public static void main(String[] args) {
        div(3, 0);
        div(5, -2);
	}
}
```
## ラッパークラス
```java
public class MyApp {
    public static void main(String[] args) {
        //Integer i = new Integer(32);
        //int n = i.intValue();
        
        Integer i = 32; //auto boxing
        i = null
        int n = i; //auto unboxing
    }
}
```
## ジェネリクス
```java
//generics

class MyInteger {
    public void getThree(int x) {
        System.out.println(x);
        System.out.println(x);
        System.out.println(x);
    }
}

class MyData<T> {
    public void getThree(T x) {
        System.out.println(x);
        System.out.println(x);
        System.out.println(x);
    }
}

public class MyApp {
    public static void main(String[] args) {
        //MyInteger mi = new MyInteger();
        //mi.getThree(55);
        MyData<Integer> i = new MyData<>();
        i.getThree(32);
        MyData<String> s = new MyData<>();
        s.getThree("hello");
    }
}
```
## スレッド処理
```java
//Thread

class MyRunnable implements Runnable {
    @override
    public void run() {
        for(int i = 0; i < 500; i++) {
            System.out.print('*');
        }
	}
}

public class MyApp {
    public static void main(String[] args) {
        MyRunnable r = new MyRunnable();
        Thread t = new Thread(r);
        t.start();
        
        for(int i = 0; i < 500; i++) {
            System.out.print('.');
        }
    }
}
```
## 無名関数 ラムダ式
```java
//Thread

//class MyRunnable implements Runnable {
//    @Override
//    public void run() {
//        for(int i = 0; i < 500; i++) {
//            System.out.print('*');
//        }
//	  }
//}

public class MyApp {
    pulblic static void main(String[] args) {
        MyRunnable r = new MyRunnable();
        Thread t = new Thread(r);
        t.start();
        
        new Thread(new Runnable(){
            @override
            public void run() {
                for (int i = 0; i < 500; i++) {
                    System.out.print('*');
				}
			}
        }).start();
        
        new Thread(() -> {
            for(int i = 0; i < 500; i++) {
                System.out.print('*');
            }
        }).start();
        
        for(int i = 0; i < 500; i++) {
            System.out.print('.');
		}
	}
}
```
## String
```java
public class MyApp {
    public static void main(String[] args) {
        String s = "abcdef";
        System.out.println(s.length());
        System.out.println(s.substring(2, 5));
        System.out.println(s.replaceAll("ab", "AB"));
        
        String ss1 = new String("ab");
        String ss2 = new String("ab");
        
        if(ss1 == ss2) {
            System.out.println("same!same!same!")
		}
    }
}
```

## printf

```java
public class MyApp {
    public static void main(String[] args) {
        int score = 50;
        doble height = 165.8;
        String name = "taguchi";
        
        System.out.printf("name: %s, score %d, height; %f\n", name, score, height);
        System.out.printf("name: %-10s, score: %10d, height: %5.2f\n", name, score, height);
        
        String s = String.format("name: %10s, score: %-10d, height: %5.2f\n", name, score, height);
    	System.out.println(s);
    }
}
```
## Math Randomクラス
```java
import java.util.Random;

public class MyApp {
    public static void main(String[] args) {
    	public d = 53.234;
    	System.out.println(Math.ceil(d));
    	System.out.println(Math.floor(d));
    	System.out.println(Math.round(d));
    	System.out.println(Math.PI);
    	//Math.random()
    
    	Random r = new Random();
    	System.out.println(r.nextDouble());
    	System.out.println(r.nextInt(100));
    	System.out.println(r.nextBoolean());
	}
}
```
## ArrayList
```java
import java.util.*;

public class MyApp {
    public static void main(String[] args) {
        //ArrayList
        //LinkedList
        
        //ArrayList<Integer> sales = new ArrayList<>();
        List<Integer> sales = new ArrayList<>();
        
        sales.add(10);
        sales.add(20);
        sales.add(30);
        
        for (int i = 0; i < sales.size(); i++) {
            System.out.println(sale);
        }
	}
}
```
## HashSet
```java
import java.util.*;

public class MyApp {
    //HashSet
    //TreeSet
    //LinkedHashSet
    
    //HashSet<Integer> sales = new HashSet<>();
    Set<Integer> sales = new HashSet<>();
    
    sales.add(10);
    sales.add(20);
    sales.add(30);
    sales.add(10);
    
    System.out.println(sales.size());
    
    for(Integer sale : sales) {
        System.out.println(sale);
	}
    
    sales.remove(30);
    
    for (Integer sale : sales) {
        System.out.println(sale);
	}
}
```
## HashMap
```java
import java.util.*;

public class MyApp {
    public static void main(String[] args) {
        //HashMap: key value
        //TreeMap
        //LinkedHashMap
        
        //HashMap<String, Integer> sales = new HashMap<>();
        Map<String, Integer> sales = new HashMap<>();
        
        sales.put("tom", 10);
        sales.put("bob", 20);
        sales.put("Steve", 30);
        
        System.out.println(sales.get("tom"));
        System.out.println(sales.size());
        
        for (Map.Entry<String, Integer> sale : sales.entrySet()) {
            System.out.println(sale.getKey() + ":" + sale.getValue());
        }
        
        sales.put("tom", 100);
        sales.remove("steve");
        
        for (Map.Entry<String, Integer> sale : sales.entrySet()) {
            System.out.println(sale.getKey() + ":" + sale.getValue());
		}
    }
}
```
## StreamAPI
```java
import java.util.*;

public class MyApp {
    public static void main(String[] args) {
        //Stream
        List<Integer> sales = new ArrayList<>(Arrays.asList(12, 30, 22, 4, 9));
        //for(Integer sale : sales) {
        //	System.out.println(sale);
    	//}
        
        sales.stream()
        //中間処理
        .filter(e -> e % 3 == 0)//ラムダ式 引数 -> 処理
        .map(e -> "(" + e + ")")
        //末端処理
        .forEach(System.out::println);
    }
}
```
##  LocalDateTime
```java
import java.time.*;
import java.time.format.DateTimeFormatter;

public class MyApp {
    public static void main(String[] args) {
        LocalDateTime d = LocalDateTime.now();
    	LocalDateTime d = LocalDateTime.of(2016, 1, 1, 10, 10, 10);
    	LocalDateTime d = LocalDateTime.of("2016-01-01-T10:10:10");

    	System.out.println(d.getYear());
    	System.out.println(d.getMonth());
    	System.out.println(d.getMonth().getValue());
    
    	System.out.println(d.plusMonth(2).minusDays(3));
    
		DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyy!MM!dd!");
    	System.out.println(d.format(dtf));
    }
}
```

