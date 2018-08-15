# for COUNT in $(seq 1 10);do
#     echo $COUNT
#     sleep 1
# done

# echo 1
# sleep 1

# echo 2
# sleep 1

# echo 3

#!/bin/bash
for ((COUNT = 1; COUNT <= 10; COUNT++)); do
  echo $COUNT
  sleep 1
done