import { Typography } from "@mui/material"

export default function Overview() {
  return (
    <>
      <Typography variant="h4">Visão Geral do Projeto</Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        O case proposto foi bastante interessante e bem estruturado, o que
        tornou o processo de desenvolvimento uma experiência enriquecedora.
      </Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        Consegui implementar todos os testes no backend e a maior parte das
        funcionalidades no frontend, apesar de alguns desafios com o tempo.
      </Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        Embora o prazo tenha sido apertado, consegui focar nas funcionalidades
        essenciais e gostaria de ter explorado mais a relação entre livros e
        leitores no contexto dos empréstimos.
      </Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        Também houve a tentativa de adicionar uma nova entidade ao sistema, mas
        isso exigiria um planejamento maior de implementação devido à
        complexidade de novas ações e objetos de valor.
      </Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        Alguns aspectos do frontend poderiam ser mais otimizados, especialmente
        em relação ao cache do Next.js e renderização do lado do servidor, além
        de melhorias na experiência do usuário, como feedbacks mais visuais
        sobre as ações executadas.
      </Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        Uma outra funcionalidade que considerei importante foi permitir ao
        usuário selecionar datas personalizadas para os empréstimos, mas, por
        uma questão de tempo, ficou configurado com um valor padrão de 8 dias.
      </Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        Senti falta de utilizar algumas bibliotecas que poderiam melhorar a
        interface do usuário, mas priorizei o cumprimento do prazo, o que me
        levou a simplificar algumas escolhas no front.
      </Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        Configurei o template de debug do Next.js para o VSCode, o que facilita
        bastante o desenvolvimento. No entanto, não consegui integrar o Xdebug
        no backend por falta de tempo.
      </Typography>
      <Typography variant="body2" sx={{ marginTop: 2 }}>
        A seguir estão as listas do que foi implementado e o que gostaria de ter
        finalizado:
      </Typography>
      <Typography sx={{ margin: "20px", fontWeight: "bold" }}>
        Tarefas Concluídas
      </Typography>
      <ul>
        <li>Implementação de testes no backend - 100%</li>
        <li>Implementação de funcionalidades principais no frontend - 91.3%</li>
        <li>Documentação da API com Swagger</li>
        <li>Documentação do código backend</li>
      </ul>
      <Typography sx={{ margin: "20px", fontWeight: "bold" }}>
        Tarefas Pendentes
      </Typography>
      <ul>
        <li>Adição de verificações extras no backend para maior robustez</li>
        <li>Integração de mais bibliotecas para melhorar o frontend</li>
        <li>
          Adição de funcionalidades no frontend, como seleção de datas de
          empréstimo e associação de leitores
        </li>
        <li>
          Otimizações no frontend, incluindo cache e renderização server-side
        </li>
        <li>
          Feedbacks mais visuais e interativos para o usuário (ex: notificações
          toast)
        </li>
      </ul>
    </>
  )
}
