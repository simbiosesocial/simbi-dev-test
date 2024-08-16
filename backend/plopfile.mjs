import fs from "node:fs";

export default (plop) => {
    plop.addHelper("namespaceHelper", (path) => {
        if (typeof path !== "string") {
            return;
        }
        const parts = path.split("/");
        return parts.map((part) => part.replace(/^\w/, (c) => c.toUpperCase())).join("\\");
    });
    plop.setGenerator("core-entity", {
        description: "Cria um novo diretório de entity com interface e classe padrão",
        prompts: [
            {
                type: "input",
                name: "name",
                message: "Digite o nome da entity (ex: User)",
            },
            {
                type: "input",
                name: "path",
                message: `Onde deve ser criado a ?. \n\n ---------------------------------- \n INSTRUÇÕES:\n especifique o caminho completo como \n\n app/Core/Domain/[domínio]/Entity \n\n - \n ex: app/Core/Domain/User/Entity \n ---------------------------------- \n\n Escreva o caminho da Entity (sem o nome): `,
            },
        ],
        actions: (data) => {
            const entityPath = `${data.path}`;
            const entityName = "{{pascalCase name}}";
            const actualentityPath = `${data.path}/${data.name}`;

            if (fs.existsSync(actualentityPath )) {
                throw new Error(`Entity '${data.name}' já existe`);
            }

            const namespace = plop.getHelper("namespaceHelper")(data.path);

            return [
                {
                    type: "add",
                    path: `${entityPath}/${entityName}.php`,
                    templateFile: "./templates/Core/Domain/Entity/Entity.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                }
            ];
        },
    });

    plop.setGenerator("use-case", {
        description: "Cria um novo diretório de use case com interface e respectivas classes padrão",
        prompts: [
            {
                type: "input",
                name: "name",
                message: "Digite o nome do use case (ex: ListUsers)",
            },
            {
                type: "input",
                name: "path",
                message: `Onde deve ser criado o use case?. \n\n ---------------------------------- \n INSTRUÇÕES:\n especifique o caminho completo como \n\n app/Core/Domain/[domínio]/Port/UseCase \n\n - \n ex: app/Core/Domain/Brokerage/Port/UseCase \n ---------------------------------- \n\n Escreva o caminho do use case (sem o nome): `,
            },
        ],
        actions: (data) => {
            const useCasePath = `${data.path}/{{pascalCase name}}UseCase`;
            const useCaseName = "{{pascalCase name}}";
            const actualUseCasePath = `${data.path}/${data.name}`;

            if (fs.existsSync(actualUseCasePath)) {
                throw new Error(`UseCase '${data.name}' já existe`);
            }

            const namespace = plop.getHelper("namespaceHelper")(data.path);

            return [
                {
                    type: "add",
                    path: `${useCasePath}/${useCaseName}UseCase.php`,
                    templateFile: "./templates/Core/Domain/Port/UseCase/UseCase.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                },
                {
                    type: "add",
                    path: `${useCasePath}/${useCaseName}RequestModel.php`,
                    templateFile: "./templates/Core/Domain/Port/UseCase/RequestModel.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                },
                {
                    type: "add",
                    path: `${useCasePath}/${useCaseName}ResponseModel.php`,
                    templateFile: "./templates/Core/Domain/Port/UseCase/ResponseModel.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                },
                {
                    type: "add",
                    path: `${useCasePath}/${useCaseName}OutputPort.php`,
                    templateFile: "./templates/Core/Domain/Port/UseCase/OutputPort.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                },
            ];
        },
    });

    plop.setGenerator("core-persistence-repository", {
        description: "Cria um novo diretório de repository com interface e classe padrão",
        prompts: [
            {
                type: "input",
                name: "name",
                message: "Digite o nome do repository (ex: User)",
            },
            {
                type: "input",
                name: "path",
                message: `Onde deve ser criado o ?. \n\n ---------------------------------- \n INSTRUÇÕES:\n especifique o caminho completo como \n\n app/Core/Domain/[domínio]/Port/Persistence \n\n - \n ex: app/Core/Domain/User/Port/Persistence \n ---------------------------------- \n\n Escreva o caminho do repository (sem o nome): `,
            },
        ],
        actions: (data) => {
            const persistenceCasePath = `${data.path}`;
            const repositoryName = "{{pascalCase name}}";
            const actualPersistencePath = `${data.path}/${data.name}`;

            if (fs.existsSync(actualPersistencePath)) {
                throw new Error(`Repository '${data.name}' já existe`);
            }

            const namespace = plop.getHelper("namespaceHelper")(data.path);

            return [
                {
                    type: "add",
                    path: `${persistenceCasePath}/${repositoryName}Repository.php`,
                    templateFile: "./templates/Core/Domain/Port/Persistence/Repository.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                }
            ];
        },
    });

    plop.setGenerator("core-exception", {
        description: "Cria um novo diretório de exception com interface e classe padrão",
        prompts: [
            {
                type: "input",
                name: "name",
                message: "Digite o nome da exception (ex: UserNameIsRequired)",
            },
            {
                type: "input",
                name: "path",
                message: `Onde deve ser criado o ?. \n\n ---------------------------------- \n INSTRUÇÕES:\n especifique o caminho completo como \n\n app/Core/Domain/[domínio]/Exceptions \n\n - \n ex: app/Core/Domain/User/Exceptions \n ---------------------------------- \n\n Escreva o caminho do repository (sem o nome): `,
            },
        ],
        actions: (data) => {
            const exceptionPath = `${data.path}`;
            const exceptionName = "{{pascalCase name}}";
            const actualExceptionPath = `${data.path}/${data.name}`;

            if (fs.existsSync(actualExceptionPath )) {
                throw new Error(`Repository '${data.name}' já existe`);
            }

            const namespace = plop.getHelper("namespaceHelper")(data.path);

            return [
                {
                    type: "add",
                    path: `${exceptionPath}/${exceptionName}.php`,
                    templateFile: "./templates/Core/Domain/Exception/Exception.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                }
            ];
        },
    });

    plop.setGenerator("core-service", {
        description: "Cria um novo diretório de service com interface e classe padrão",
        prompts: [
            {
                type: "input",
                name: "domainName",
                message: "Digite o nome do Domínio (ex: User)",
            },
            {
                type: "input",
                name: "name",
                message: "Digite o nome do Service (ex: CreateUser)",
            },
            {
                type: "input",
                name: "repositoryName",
                message: "Digite o nome do repository (ex: UserRepository)",
            },
            {
                type: "input",
                name: "path",
                message: `Onde deve ser criado o ?. \n\n ---------------------------------- \n INSTRUÇÕES:\n especifique o caminho completo como \n\n app/Core/Services/[domínio] \n\n - \n ex: app/Core/Services/User \n ---------------------------------- \n\n Escreva o caminho do service (sem o nome): `,
            },
        ],
        actions: (data) => {
            const exceptionPath = `${data.path}`;
            const exceptionName = "{{pascalCase name}}";
            const actualExceptionPath = `${data.path}/${data.name}`;

            if (fs.existsSync(actualExceptionPath )) {
                throw new Error(`Service '${data.name}' já existe`);
            }

            const namespace = plop.getHelper("namespaceHelper")(data.path);

            return [
                {
                    type: "add",
                    path: `${exceptionPath}/${exceptionName}Service.php`,
                    templateFile: "./templates/Core/Service/Service.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                }
            ];
        },
    });

    plop.setGenerator("infra-adapter", {
        description: "Cria um novo diretório de adapter com interface e classe padrão",
        prompts: [
            {
                type: "input",
                name: "domainName",
                message: "Digite o nome do Domínio (ex: User)",
            },
            {
                type: "input",
                name: "name",
                message: "Digite o nome do mapper (ex: UserMapper)",
            },
            {
                type: "input",
                name: "path",
                message: `Onde deve ser criado o ?. \n\n ---------------------------------- \n INSTRUÇÕES:\n especifique o caminho completo como \n\n app/Infra/Adapters/Persistence/Eloquent/Mapper/[domínio] \n\n - \n ex: app/Infra/Adapters/Persistence/Eloquent/Mapper/User \n ---------------------------------- \n\n Escreva o caminho do adapter (sem o nome): `,
            },
        ],
        actions: (data) => {
            const adapterPath = `${data.path}`;
            const adapterName = "{{pascalCase name}}";
            const actualAdapterPath = `${data.path}/${data.name}`;

            if (fs.existsSync(actualAdapterPath)) {
                throw new Error(`Adapter '${data.name}' já existe`);
            }

            const namespace = plop.getHelper("namespaceHelper")(data.path);

            return [
                {
                    type: "add",
                    path: `${adapterPath}/${adapterName}.php`,
                    templateFile: "./templates/Infra/Adapters/Adapter.php.hbs",
                    abortOnFail: true,
                    data: {
                        namespace,
                    },
                }
            ];
        },
    });
    
};