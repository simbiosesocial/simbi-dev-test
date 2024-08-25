import { Typography } from "@mui/material";

export default function Overview() {
  return (
    <>
        <Typography variant="h4">Aloha!</Typography>
        <Typography variant="body2">Em primeiro lugar, gostei bastante do case, muito bem formatado</Typography>
        <Typography variant="body2">Apesar de tudo, deu para implementar todos os testes no back e a maior parte do front</Typography>
        <Typography variant="body2">Gostaria de ter aproveitado mais o tempo no escopo do projeto</Typography>
        <Typography variant="body2">Gostaria de ter explorado melhor a relação n-n de empréstimos entre livros e leitores, mas não dava tempo de adicionar mais uma entidade, bem como as suas ações, cheguei a adicionar a entidade com alguns objetos de valor, mas, dentre essas e outras demandas da vida cotidiana, o tempo era curto</Typography>
        <Typography variant="body2">Ficaram faltando algumas etapas dentre otimizações no front para o melhor aproveitamento do cache do nextjs e renderização server-side, até melhores feedbacks para o usuário sobre as tarefas executadas, bem como outras features como permitir ao usuário selecionar as datas de empréstimo (que ficaram em 8 dias por padrão)</Typography>
        <Typography variant="body2">Também senti falta de adicionar algumas libs para deixar o front mais supimpa, tive que evitar em benefício do tempo</Typography>
        <Typography variant="body2">Adicionei o template de debug do nextjs para o vscode para facilitar a vida, não coloquei o xdebug instalado no container do back porque não deu tempo</Typography>
        <Typography variant="body2">Sem mais delongas aqui vão duas listas do que fiz e do que gostaria de ter feito/finalizado</Typography>
        <Typography sx={{ margin: "20px" }}>Done</Typography>
        <ul>
            <li>Tests backend - 100%</li>
            <li>Tests backend - 91.3%</li>
            <li>Doc Swagger backend</li>
            <li>Code Doc backend</li>
        </ul>
        <Typography sx={{ margin: "20px" }}>TODO</Typography>
        <ul>
            <li>Adição de mais verificações no backend</li>
            <li>Adição de mais libs</li>
            <li>Adição de mais features no front como selecionar datas de vencimento empréstimo, leitores, etc</li>
            <li>Adição de mais otimizações para o front (cache - renderização server-side)</li>
            <li>Melhores feedbacks para o usuário, notificações toasts, dentre outas</li>
        </ul>
    </>
  );
}
