using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR32
{
    //Класс по конвертации регистра запроса
    class SQLCommand
    {
        //Инициализация свойства класса
        public string CommandText { get { return cmdtxt; } set { cmdtxt = RegUpper(value); } }

        //Создание переменной, хранящей значение свойства
        public string cmdtxt;

        //Метод по конвертации регистра
        private string RegUpper(string txt)
        {
            return txt.Replace("select", "SELECT")
                .Replace("create", "CREATE")
                .Replace("from", "FROM")
                .Replace("alter","ALTER")
                .Replace("drop","DROP")
                .Replace("insert", "INSERT")
                .Replace("delete", "DELETE")
                .Replace("update", "UPDATE")
                .Replace("grant", "GRANT")
                .Replace("revoke", "REVOKE")
                .Replace("deny", "DENY")
                .Replace("all", "ALL")
                .Replace("between", "BETWEEN")
                .Replace("exists", "EXISTS")
                .Replace("in", "IN")
                .Replace("like", "LIKE")
                .Replace("not", "NOT")
                .Replace("or", "OR")
                .Replace("is null", "IS NULL")
                .Replace("unique", "UNIQUE")
                .Replace("join", "JOIN")
                .Replace("where", "WHERE")
                .Replace("group by", "GROUP BY")
                .Replace("order by", "ORDER BY")
                .Replace("limit", "LIMIT");
        }
    }

    //Клиентский код
    class Program
    {
        static void Main(string[] args)
        {
            //Инициализация объектов
            SQLCommand sqlcomm = new SQLCommand();

            //Вывод приветствия пользователя
            Console.Write("Вас приветствует транслятор SQL запросов." +
                "\nДанная программа предназначена для повышения регистра SQL-операторов" +
                "\nВведите ваш запрос: ");

            //Ввод запроса
            sqlcomm.CommandText = Console.ReadLine();

            //Вывод обработанного запроса
            Console.Write($"<+==0==+>" +
                $"\nВаш конвертированный запрос: {sqlcomm.CommandText}");
            Console.ReadKey();
        }
    }
}
