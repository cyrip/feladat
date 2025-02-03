<?php

namespace Task\Task4;

class EvenCounter
{
  const int MAX_NUMBER = 10000;

  public function __construct()
  {
  }

  public function run()
  {
    printf("\nRun Task4 ...\n");
    printf("Even numbers count: %d\n", $this->evenCount(range(1, self::MAX_NUMBER)));
  }

  public function evenCount(array $range): int
  {
    return count(array_filter($range, fn(int $number) =>  $number % 2 == 0));
  }
}
?>
