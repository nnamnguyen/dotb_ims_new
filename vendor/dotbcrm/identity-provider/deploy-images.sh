#!/bin/bash
cd /tmp
rm -rf /tmp/IdentityProvider
git clone git@github.com:dotbcrm/IdentityProvider.git
cd IdentityProvider

docker build --pull -t registry.dotbcrm.net/identity-provider/identity-provider:latest -f app/deploy/Dockerfile .

read -p "Push to dotb registry? [y/n]" yn
case $yn in
  [Yy]* ) docker push registry.dotbcrm.net/identity-provider/identity-provider:latest
;;
esac

read -p "Push to quay? [y/n]" yn
case $yn in
  [Yy]* )
     tag='manual-'`date -u +%Y%m%d%H%M`
     docker tag registry.dotbcrm.net/identity-provider/identity-provider:latest quay.io/dotbcrm/idm-login:$tag
     docker tag registry.dotbcrm.net/identity-provider/identity-provider:latest quay.io/dotbcrm/idm-login:latest-manual
     docker login quay.io
     docker push quay.io/dotbcrm/idm-login:$tag
     docker push quay.io/dotbcrm/idm-login:latest-manual
  ;;
esac

