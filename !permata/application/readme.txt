HOW TO QUERY HERE
=================

SELECT zpxf_product.id_product, zpxf_product.alias, zpxf_product_price.actual_price
FROM zpxf_product
LEFT JOIN zpxf_product_price ON zpxf_product.id_product = zpxf_product_price.id_product
WHERE zpxf_product.alias =  'ipod'
LIMIT 0 , 30

Note ** use id_product for use one or more table