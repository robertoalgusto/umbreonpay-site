#!/usr/bin/env python3
import asyncio
import websockets
import json

DON_KEY = "tws_shira_master_key_2026"

async def handler(websocket):
    chave = await websocket.recv()
    if chave != DON_KEY:
        await websocket.send("⛔ Acesso negado")
        return
    
    await websocket.send("✅ Conectado como Don")
    
    async for mensagem in websocket:
        resposta = f"SHIRA: Processando '{mensagem}'"
        await websocket.send(resposta)

start_server = websockets.serve(handler, "0.0.0.0", 8765)
asyncio.get_event_loop().run_until_complete(start_server)
asyncio.get_event_loop().run_forever()
