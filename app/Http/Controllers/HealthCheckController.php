<?php

namespace App\Http\Controllers;

/**
 * Controller para documentar biblioteca de HealthCheck
 *
 * Utilizada a biblioteca HealthCheck para verificar os status de serviços de log, database, env e rabbitMQ.
 *
 * @see https://github.com/ans-group/laravel-health-check
 */
final class HealthCheckController
{
    /**
     * Mostra o status dos serviços do sistema
     *
     * @OA\Get(
     *     path="/health",
     *     summary="Mostra o status dos serviços do sistema.",
     *     tags={"Health Check"},
     *
     *     @OA\Response(response="200", description="Dados buscados com sucesso.",
     *       @OA\MediaType(
     *        mediaType="application/json",
     *          @OA\Schema(
     *              @OA\Property(property="status", type="string", description="status geral.", example="OK"),
     *              @OA\Property(property="log", type="object",
     *                @OA\Property(property="status", type="string", description="status de log.", example="OK")
     *              ),
     *              @OA\Property(property="database", type="object",
     *                @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  description="status do banco de dados.",
     *                  example="OK"
     *                )
     *              ),
     *              @OA\Property(property="env", type="object",
     *                @OA\Property(property="status", type="string", description="status do env.", example="OK")
     *              ),
     *              @OA\Property(property="rabbit-mq-check", type="object",
     *                @OA\Property(property="status", type="string", description="status do RabbitMQ.", example="OK")
     *              ),
     *           )
     *        )
     *     ),
     * )
     */
    public function healthCheck()
    {
    }

    /**
     * Verifica se a aplicação está online
     *
     * @OA\Get(
     *     path="/ping",
     *     summary="Retorna pong se a aplicação está online.",
     *     tags={"Health Check"},
     *
     *     @OA\Response(response="200", description="Aplicação online.",
     *        @OA\MediaType(
     *        mediaType="text/html",
     *           @OA\Schema(
     *             example="pong"
     *           )
     *        )
     *       )
     *     ),
     * )
     */
    public function ping()
    {
    }
}
