#!/bin/bash

cd ..
zip ibeike_ucenter.zip ibeike_ucenter -r \
        -x "./ibeike_ucenter/node*" \
        -x "./ibeike_ucenter/vendor*" \
        -x "./ibeike_ucenter/storage*" \
        -x "./ibeike_ucenter/.git*"
scp -P 21212 ./ibeike_ucenter.zip jason@www.ibeike.com:~
# rm ibeike_ucenter.zip
cd -
