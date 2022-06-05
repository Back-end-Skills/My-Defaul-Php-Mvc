<h1 text-align="center"> My-Defaul-Php-Mvc </h1>
Meu padrão php mvc aplicados em Projects 

<p>verificaParametros(): <br>
esse método vai verificar se foi requisitado algum parâmetro na url, então se for apenas o "localhost" ou "seusite.com" ele já vai definir o atributo page como views/index.php senão ele vai chamar o método verificaDir().</p>

<p>verificaDir():<br> possui a função de verificar se o parâmetro passado na url é um diretório e caso for ele vai concatenando até gerar uma árvore de diretórios. Quando não for mais um diretório requisitado ele vai setar o atributo file.</p>

<p>verificaFile():<br> esse método verifica se existe o arquivo .php solicitado pelo atributo $this->file, se existir ele já atribui ao atributo page aquele caminho, senão ele verifica se existe dentro do diretório o arquivo index.php e atribui o $this->page. Se de tudo não existir, ele chama a página de erro 404.php.</p>

<p>verificaFile():<br> esse método verifica se existe o arquivo .php solicitado pelo atributo $this->file, se existir ele já atribui ao atributo page aquele caminho, senão ele verifica se existe dentro do diretório o arquivo index.php e atribui o $this->page. Se de tudo não existir, ele chama a página de erro 404.php.</p>

<p>getInclusao():<br> retorna para o sistema o atributo page. Esse atributo já vem com todos os diretórios concatenados e com o arquivo.php, pronto para ser incluído no sistema.</p>
