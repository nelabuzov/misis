using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR63
{
    //Родительский класс
    class OperationSystem
    {
        //Инициализация свойств
        public string Name { get; private set; }
        public string NameFileSystem { get; private set; }
        public string CommandShell { get; private set; }
        public string NameKernel { get; private set; }

        //Констркутор приёма родительских свойств
        public OperationSystem(string name, string namefs, string commandsh, string nameker)
        {
            Name = name;
            NameFileSystem = namefs;
            CommandShell = commandsh;
            NameKernel = nameker;
        }
    }

    //Дочерний класс
    class WindowsNT : OperationSystem
    {
        //Инициализация дочерних свойств
        public string Additions { get; private set; }

        //Конструктор приёма родительских и дочерних свойств
        public WindowsNT(string name, string namefs, string commandsh, string nameker, string additions) : base(name, namefs, commandsh, nameker)
        {
            Additions = additions;
        }

        //Метод показывающий информацию "О системе"
        public void About()
        {
            //Очистка экрана, смена фона и шрифта
            Console.BackgroundColor = ConsoleColor.Blue;
            Console.Clear();
            Console.ForegroundColor = ConsoleColor.White;

            //Вывод информации о ОС
            Console.Write($"Name: {Name}" +
                $"\nName of FileSystem: {NameFileSystem}" +
                $"\nCommand Shell: {CommandShell}" +
                $"\nName of Kernel: {NameKernel}" +
                $"\nAdditions: {Additions}");
        }
    }

    //Дочерний класс
    class Linux : OperationSystem
    {
        //Инициализация дочерних свойств
        public string GraphicalSubSystem { get; private set; }
        public string PackageManager { get; private set; }
        public string TypeDriver { get; private set; }

        //Конструктор приёма родительских и дочерних свойств
        public Linux(string name, string namefs, string commandsh, string nameker, string gsm, string pacman, string typedrivers) : base(name, namefs, commandsh, nameker)
        {
            GraphicalSubSystem = gsm;
            PackageManager = pacman;
            TypeDriver = typedrivers;
        }

        //Метод показывающий информацию "О системе"
        public void About()
        {
            //Очистка экрана, смена фона и шрифта
            Console.BackgroundColor = ConsoleColor.Black;
            Console.Clear();
            Console.ForegroundColor = ConsoleColor.White;

            //Вывод информации о ОС
            Console.Write($"Name: {Name}" +
                $"\nName of FileSystem: {NameFileSystem}" +
                $"\nCommand Shell: {CommandShell}" +
                $"\nName of Kernel: {NameKernel}" +
                $"\nGraphical SubSystem: {GraphicalSubSystem}" +
                $"\nPackage Manager: {PackageManager}" +
                $"\nType driver: {TypeDriver}" +
                $"\nOOPS KERNEL PANIC!");
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            //Инициализация свойств
            Linux debian = new Linux("GNU/Linux Debian 11","Ext4","dsh","Linux 5.15","Xorg", "Apt","OpenDrivers");
            WindowsNT windows22 = new WindowsNT("Windows Server 22 Enterprise Edition","NTFS", "PowerShell", "WindowsNT", "All right Resistend");

            //Приветствие
            Console.WriteLine("Hello this micro-handbook about OperationSystem" +
                "\nSelect OS(WindowsNT/Linux): W/L ");
            char sel = char.Parse(Console.ReadLine());
            
            //Выбор ОС
            if(sel == 'L' | sel == 'l')
                debian.About();
            else if (sel == 'W' | sel == 'w')
                windows22.About();
            else
            {
                Console.BackgroundColor = ConsoleColor.Black;
                Console.Clear();
                Console.Write("OOOPS, YOU LOSE");
            }
            Console.ReadKey();
        }

    }
}
