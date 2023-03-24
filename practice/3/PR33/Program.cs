using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace PR33
{
    //Класс подсчёта среднего арифметического значения
    class MyIntList
    {
        //Инициализация поля
        private List<int> numberList = new List<int>();

        //Свойство вывода среднего значения 
        public double Average
        {
            get
            {
                return CalculateAverage();

            }
        }

        //Ввод массива чисел
        public void AddNumberRange(int[] numbers)
        {
            numberList.AddRange(numbers);
        }

        //Ввод одного значения в список
        public void AddNumber(int number)
        {
            numberList.Add(number);
        }

        //Удаление одного значения в списке
        public void RemoveNumber(int number)
        {
            numberList.Remove(number);
        }

        //Расчёт среднего арифметического
        private double CalculateAverage()
        {
            int sum = 0;
            foreach (int number in numberList)
            {
                sum += number;
            }
            return sum / (double)numberList.Count;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
                MyIntList numbers = new MyIntList();

            Console.Write("Вас приветствует программа Average300" +
                "\nВведите ваши числа, черещ пробел: ");

                numbers.AddNumberRange(new[] { 1,2,3,4});
                Console.WriteLine(numbers.Average);
        }
    }
}
