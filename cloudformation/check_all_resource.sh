# check all resources in aws accout
# https://qiita.com/shu85t/items/241ffce4de64370aadbd

# 実行方法
# sh check_all_resouce.sh [profile-name]

for region in `aws ec2 describe-regions --query 'Regions[].RegionName' --region us-west-1 --output text --profile $1`
do
  echo "region = ${region}"
  aws resourcegroupstaggingapi get-resources --region ${region} --query 'ResourceTagMappingList[].ResourceARN' --profile $1;
done

echo "global"
echo "IAM"
aws iam list-users --query 'Users[].Arn' --profile $1
aws iam list-roles --query 'Roles[].Arn' --profile $1

echo "finished"