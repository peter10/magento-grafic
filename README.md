Selected files from the Grafic project.

One interesting thing about this project was that the client wanted the ability to add products to the cart directly from the 'related products' list on the product page. This turned out to be pretty involved as Magento assumes that if you're adding a product to the cart then it's the actual product who's page you're on, not some other product. So I got to dig into the JavaScript that does this and figured out a way to generalize it. I was never convinced this was good for usability but it was important to the client so we made it happen.
Relevent files:
[Related.php](app/code/local/Demac/Grafic/Block/Catalog/Product/List/Related.php)
[related.phtml](app/design/frontend/enterprise/grafic/template/targetrule/catalog/product/list/related.phtml)

Another interesting thing was that the original design called for two less products to be displayed on the home page compared to other pages. One solution is to adjust the product collection in an observer, and you can see this code here: [Observer.php](app/code/local/Demac/Grafic/Model/Observer.php)

We ended up switching to a responsive design so this code turned out to be unneccesary. It did inspire a couple of blog posts, if you're interested please see  
http://www.demacmedia.com/magento-commerce/pagination-tricks-in-magento-part-1/  
http://www.demacmedia.com/magento-commerce/pagination-tricks-in-magento-part-2/
