# check all resources in aws accout
# https://qiita.com/shu85t/items/241ffce4de64370aadbd

for region in `aws ec2 describe-regions --query 'Regions[].RegionName' --region us-west-1 --output text`
do
  echo "region = ${region}"
  aws resourcegroupstaggingapi get-resources --region ${region} --query 'ResourceTagMappingList[].ResourceARN';
done

echo "global"
echo "IAM"
aws iam list-users --query 'Users[].Arn'
aws iam list-roles --query 'Roles[].Arn'

echo "finished"