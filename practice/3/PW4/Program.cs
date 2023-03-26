using System;

namespace PW4
{
    class IntList
    {
        private List<int> numberList = new List<int>();

        public double Average
        {
            get
            {
                return CalculateAverage();

            }
        }

        public void AddNumberRange(int[] numbers)
        {
            numberList.AddRange(numbers);
        }

        public void AddNumber(int number)
        {
            numberList.Add(number);
        }

        public void RemoveNumber(int number)
        {
            numberList.Remove(number);
        }

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
            IntList numbers = new IntList();
            Console.Write("Программа Average" +
                "\nВведите числа через пробел: ");

            numbers.AddNumberRange(new[] { 1,2,3,4});
            Console.WriteLine(numbers.Average);
        }
    }
}
