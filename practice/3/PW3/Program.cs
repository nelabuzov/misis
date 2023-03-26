using System;

namespace PW3
{
    class SQLCommand
    {
        public string CommandText { get { return cmdTXT; } set { cmdTXT = RegUpper(value); } }

        public string cmdTXT;

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

    class Program
    {
        static void Main(string[] args)
        {
            SQLCommand sqlcomm = new SQLCommand();
            Console.Write("Транслятор SQL" +
                "\nПовышение регистра операторов" +
                "\nВведите ваш запрос: ");

            sqlcomm.CommandText = Console.ReadLine();
            Console.Write($"<+==0==+>" +
                $"\nВаш конвертированный запрос: {sqlcomm.CommandText}");
            Console.ReadKey();
        }
    }
}
